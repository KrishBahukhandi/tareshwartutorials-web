<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(Batch $batch)
    {
        abort_if(! auth()->user()->isEnrolledInBatch($batch), 403);

        $assignments = $batch->assignments()
            ->with(['submissions' => function ($query) {
                $query->where('student_id', auth()->id());
            }])
            ->get();

        return view('student.batches.assignments.index', compact('batch', 'assignments'));
    }

    public function show(Batch $batch, Assignment $assignment)
    {
        abort_if(! auth()->user()->isEnrolledInBatch($batch), 403);
        abort_if($assignment->batch_id !== $batch->id, 404);

        $submission = $assignment->submissions()->where('student_id', auth()->id())->first();

        return view('student.batches.assignments.show', compact('batch', 'assignment', 'submission'));
    }

    public function submit(Request $request, Batch $batch, Assignment $assignment)
    {
        abort_if(! auth()->user()->isEnrolledInBatch($batch), 403);
        abort_if($assignment->batch_id !== $batch->id, 404);
        abort_if($assignment->due_date->isPast(), 403, 'The due date for this assignment has passed.');

        $validated = $request->validate([
            'submission_file' => 'required|file|mimes:pdf|max:10240',
        ]);

        $submission = $assignment->submissions()->where('student_id', auth()->id())->first();

        $filePath = $request->file('submission_file')->store('assignments/submissions', config('filesystems.public_files'));

        if ($submission) {
            // Re-submission logic
            if ($submission->file_path) {
                Storage::disk(config('filesystems.public_files'))->delete($submission->file_path);
            }
            $submission->update([
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]);
        } else {
            $assignment->submissions()->create([
                'student_id' => auth()->id(),
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]);
        }

        $batch->recalculateProgressForStudent(auth()->id());

        return redirect()->route('student.batches.assignments.show', [$batch, $assignment])
            ->with('success', 'Assignment submitted successfully.');
    }
}
