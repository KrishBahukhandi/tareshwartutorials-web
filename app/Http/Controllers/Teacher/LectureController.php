<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StoreLectureRequest;
use App\Models\Batch;
use App\Models\Lecture;
use Illuminate\Http\RedirectResponse;

class LectureController extends Controller
{
    public function store(StoreLectureRequest $request, Batch $batch): RedirectResponse
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);

        $batch->lectures()->create($request->validated());

        return redirect()
            ->route('teacher.batches.show', ['batch' => $batch, 'tab' => 'lectures'])
            ->with('success', 'Lecture "'.e($request->title).'" has been added successfully.');
    }

    public function destroy(Batch $batch, Lecture $lecture): RedirectResponse
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);
        abort_if($lecture->batch_id !== $batch->id, 404);

        $lecture->delete();

        return redirect()
            ->route('teacher.batches.show', ['batch' => $batch, 'tab' => 'lectures'])
            ->with('success', 'Lecture has been removed.');
    }
}
