<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Batch;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Batch $batch, Assignment $assignment)
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);
        abort_if($assignment->batch_id !== $batch->id, 404);

        $submissions = $assignment->submissions()->with('student')->get();
        
        // Also get enrolled students who haven't submitted yet
        $enrolledStudentIds = $batch->enrollments()->where('status', 'active')->pluck('student_id');
        $submittedStudentIds = $submissions->pluck('student_id');
        
        $pendingStudents = \App\Models\User::whereIn('id', $enrolledStudentIds)
            ->whereNotIn('id', $submittedStudentIds)
            ->get();

        return view('teacher.batches.assignments.submissions.index', compact('batch', 'assignment', 'submissions', 'pendingStudents'));
    }

    public function show(Batch $batch, Assignment $assignment, AssignmentSubmission $submission)
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);
        abort_if($assignment->batch_id !== $batch->id, 404);
        abort_if($submission->assignment_id !== $assignment->id, 404);

        $submission->load('student');

        return view('teacher.batches.assignments.submissions.show', compact('batch', 'assignment', 'submission'));
    }

    public function grade(Request $request, Batch $batch, Assignment $assignment, AssignmentSubmission $submission)
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);
        abort_if($assignment->batch_id !== $batch->id, 404);
        abort_if($submission->assignment_id !== $assignment->id, 404);

        $validated = $request->validate([
            'marks_awarded' => 'required|numeric|min:0|max:' . $assignment->total_marks,
            'teacher_feedback' => 'nullable|string',
        ]);

        $submission->update([
            'marks_awarded' => $validated['marks_awarded'],
            'teacher_feedback' => $validated['teacher_feedback'],
            'graded_at' => now(),
        ]);

        return redirect()->route('teacher.batches.assignments.submissions.index', [$batch, $assignment])
            ->with('success', 'Submission graded successfully.');
    }
}
