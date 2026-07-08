<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchNote;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $notes = BatchNote::with('batch')
            ->where('teacher_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        $batches = $user->batches()->get();

        return view('teacher.resources', compact('notes', 'batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'note_file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:20480', // 20MB max
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        abort_if(! $batch->hasTeacher(auth()->id()), 403);

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

        return redirect()->route('teacher.resources')->with('success', "Resource '{$originalName}' uploaded successfully.");
    }
}
