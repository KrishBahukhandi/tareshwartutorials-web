<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBatchRequest;
use App\Models\ActivityLog;
use App\Models\Batch;
use App\Models\BatchSubject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BatchController extends Controller
{
    public function index(Request $request): View
    {
        $teachers = User::where('role', 'teacher')->where('is_active', true)->orderBy('name')->get();

        $batches = Batch::with(['teachers', 'subjects'])
            ->withEnrollmentCount()
            ->when($request->grade, fn ($q, $grade) => $q->where('grade', $grade))
            ->when($request->subject, fn ($q, $subject) => $q->whereHas('subjects', fn ($sq) => $sq->where('name', $subject)))
            ->when($request->teacher_id, fn ($q, $teacherId) => $q->whereHas('subjects', fn ($sq) => $sq->where('teacher_id', $teacherId)))
            ->orderBy('created_at', 'desc')
            ->get();

        $grades = Batch::distinct()->orderBy('grade')->pluck('grade');
        $subjects = BatchSubject::distinct()->pluck('name')->sort()->values();

        return view('admin.batches.index', compact('batches', 'teachers', 'grades', 'subjects'));
    }

    public function store(StoreBatchRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $subjects = $validated['subjects'];
        unset($validated['subjects']);

        $batch = Batch::create($validated);

        foreach ($subjects as $subjectName) {
            $batch->subjects()->create(['name' => $subjectName]);
        }

        ActivityLog::create([
            'description' => 'New batch <strong>'.e($batch->name).'</strong> created by Admin.',
            'icon' => 'batch',
            'color' => 'green',
        ]);

        return redirect()->route('admin.batches.index')
            ->with('success', "Batch \"{$batch->name}\" has been created successfully.");
    }

    public function update(StoreBatchRequest $request, Batch $batch): RedirectResponse
    {
        $batch->update($request->validated());

        return redirect()->route('admin.batches.index')
            ->with('success', "Batch \"{$batch->name}\" has been updated.");
    }

    public function show(Batch $batch): View
    {
        $batch->load('subjects.teacher');
        $teachers = User::where('role', 'teacher')->where('is_active', true)->orderBy('name')->get();

        return view('admin.batches.show', compact('batch', 'teachers'));
    }

    public function assignTeacher(Request $request, Batch $batch, BatchSubject $subject): RedirectResponse
    {
        abort_unless($subject->batch_id === $batch->id, 404);

        $request->validate([
            'teacher_id' => [
                'nullable',
                Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', 'teacher')->where('is_active', true)),
            ],
        ]);

        $subject->update(['teacher_id' => $request->teacher_id]);

        return redirect()->route('admin.batches.show', $batch)->with('success', 'Teacher assigned successfully.');
    }

    public function destroy(Batch $batch): RedirectResponse
    {
        $name = $batch->name;
        Storage::disk('public')->deleteDirectory("batch-notes/{$batch->id}");
        $batch->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', "Batch \"{$name}\" has been deleted.");
    }
}
