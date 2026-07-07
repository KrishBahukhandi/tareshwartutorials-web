<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\UpdateMeetingRequest;
use App\Models\Batch;
use Illuminate\Http\RedirectResponse;

class MeetingController extends Controller
{
    public function update(UpdateMeetingRequest $request, Batch $batch): RedirectResponse
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);

        $batch->update($request->validated());

        return redirect()
            ->route('teacher.batches.show', ['batch' => $batch, 'tab' => 'live_meeting'])
            ->with('success', 'Meeting link updated successfully. Students will see the new link immediately.');
    }
}
