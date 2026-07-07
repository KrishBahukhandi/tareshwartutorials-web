<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\StoreNoteRequest;
use App\Models\Batch;
use App\Models\BatchNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function store(StoreNoteRequest $request, Batch $batch): RedirectResponse
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);

        $file = $request->file('note_file');
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        $path = $file->store("batch-notes/{$batch->id}", 'public');

        BatchNote::create([
            'batch_id' => $batch->id,
            'teacher_id' => auth()->id(),
            'original_filename' => $originalName,
            'file_path' => $path,
            'file_type' => strtoupper($extension),
            'file_size_kb' => (int) round($file->getSize() / 1024),
        ]);

        return redirect()
            ->route('teacher.batches.show', ['batch' => $batch, 'tab' => 'notes'])
            ->with('success', "\"{$originalName}\" uploaded successfully.");
    }

    public function download(Batch $batch, BatchNote $note): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);
        abort_if($note->batch_id !== $batch->id, 404);

        return Storage::disk('public')->download($note->file_path, $note->original_filename);
    }

    public function destroy(Batch $batch, BatchNote $note): RedirectResponse
    {
        abort_if(!$batch->hasTeacher(auth()->id()), 403);
        abort_if($note->batch_id !== $batch->id, 404);

        Storage::disk('public')->delete($note->file_path);
        $note->delete();

        return redirect()
            ->route('teacher.batches.show', ['batch' => $batch, 'tab' => 'notes'])
            ->with('success', 'Note deleted.');
    }
}
