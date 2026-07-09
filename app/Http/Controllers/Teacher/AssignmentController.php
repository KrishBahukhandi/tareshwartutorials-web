<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(Batch $batch)
    {
        abort_if(! $batch->hasTeacher(auth()->id()), 403);

        $assignments = $batch->assignments()->withCount('submissions')->get();

        return view('teacher.batches.assignments.index', compact('batch', 'assignments'));
    }

    public function create(Batch $batch)
    {
        abort_if(! $batch->hasTeacher(auth()->id()), 403);

        return view('teacher.batches.assignments.create', compact('batch'));
    }

    public function store(Request $request, Batch $batch)
    {
        abort_if(! $batch->hasTeacher(auth()->id()), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $assignment = new Assignment($validated);

        if ($request->hasFile('file')) {
            $assignment->file_path = $request->file('file')->store('assignments/questions', config('filesystems.public_files'));
        }

        $batch->assignments()->save($assignment);
        $batch->recalculateAllEnrollmentProgress();

        return redirect()->route('teacher.batches.assignments.index', $batch)
            ->with('success', 'Assignment created successfully.');
    }

    public function destroy(Batch $batch, Assignment $assignment)
    {
        abort_if(! $batch->hasTeacher(auth()->id()), 403);
        abort_if($assignment->batch_id !== $batch->id, 404);

        if ($assignment->file_path) {
            Storage::disk(config('filesystems.public_files'))->delete($assignment->file_path);
        }

        $assignment->delete();
        $batch->recalculateAllEnrollmentProgress();

        return redirect()->route('teacher.batches.assignments.index', $batch)
            ->with('success', 'Assignment deleted successfully.');
    }
}
