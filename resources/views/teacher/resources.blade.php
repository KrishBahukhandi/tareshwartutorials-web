@extends('layouts.teacher')

@section('title', 'Resources')
@section('search_placeholder', 'Search resources...')

@section('content')
<div class="p-6">
    
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Resource Center</h1>
            <p class="text-sm text-gray-500 mt-1">Manage global notes, PDFs, and assets across all your batches.</p>
        </div>
        <button onclick="document.getElementById('uploadForm').classList.toggle('hidden')" class="flex items-center gap-2 bg-[#1e3a5f] hover:bg-[#162d4a] text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Upload Resource
        </button>
    </div>
    
    <div id="uploadForm" class="hidden bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">
        <h3 class="font-bold text-gray-900 mb-4">Upload New Resource</h3>
        <form method="POST" action="{{ route('teacher.resources.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Select Batch</label>
                <select name="batch_id" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]">
                    <option value="">-- Choose Batch --</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }} (Grade {{ $batch->grade }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Resource File (PDF, Word, or PowerPoint — Max 20MB)</label>
                <input type="file" name="note_file" accept=".pdf,.doc,.docx,.ppt,.pptx" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('uploadForm').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg">Cancel</button>
                <button type="submit" class="bg-[#1e3a5f] hover:bg-[#162d4a] text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">Upload</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
            <div class="flex gap-4">
                <button class="text-sm font-bold text-[#1e3a5f] border-b-2 border-[#1e3a5f] pb-1">All Files ({{ $notes->count() }})</button>
            </div>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($notes as $note)
            <div class="p-4 hover:bg-gray-50 transition-colors flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg {{ $note->file_type === 'PDF' ? 'bg-red-100' : 'bg-blue-100' }} flex items-center justify-center shrink-0">
                        @if($note->file_type === 'PDF')
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        @else
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900">{{ $note->original_filename }}</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Shared with <span class="font-medium text-gray-700">{{ $note->batch->name }}</span> • {{ $note->file_size_kb }} KB</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('teacher.batches.notes.download', [$note->batch, $note]) }}" class="p-2 text-gray-400 hover:text-[#1e3a5f] hover:bg-gray-100 rounded-md transition-colors" title="Download">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                    <form method="POST" action="{{ route('teacher.batches.notes.destroy', [$note->batch, $note]) }}" class="inline" onsubmit="return confirm('Delete this resource?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-10 text-center text-gray-500">
                You haven't uploaded any resources yet.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
