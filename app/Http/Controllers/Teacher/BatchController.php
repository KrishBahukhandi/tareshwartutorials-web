<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BatchController extends Controller
{
    public function index(): View
    {
        $batches = auth()->user()->batches()
            ->with(['lectures', 'batchNotes'])
            ->withCount('enrollments')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('teacher.batches.index', compact('batches'));
    }
    public function show(Batch $batch, Request $request): View
    {
        // Teachers can only view their own batches
        abort_if(!$batch->hasTeacher(auth()->id()), 403, 'You do not have access to this batch.');

        $tab = $request->get('tab', 'live_meeting');

        $batch->load(['lectures', 'batchNotes', 'teachers', 'enrollments.student']);

        return view('teacher.batches.show', compact('batch', 'tab'));
    }
}
