{{-- Notes Tab --}}
<div>
    {{-- Batch Info Strip --}}
    <div class="mb-5">
        <p class="text-[11px] font-bold text-blue-600 uppercase tracking-widest mb-0.5">
            {{ $batch->is_active ? 'Active Batch' : 'Inactive Batch' }} • {{ $batch->subject }}
        </p>
        <p class="text-sm text-gray-600 flex items-center gap-4">
            <span>{{ $batch->formattedSchedule() }}</span>
        </p>
    </div>

    {{-- Upload Area --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-5">
        <form method="POST"
              action="{{ route('teacher.batches.notes.store', $batch) }}"
              enctype="multipart/form-data"
              id="notes-form">
            @csrf

            <div id="drop-zone"
                 class="border-2 border-dashed border-gray-300 rounded-xl p-10 flex flex-col items-center justify-center text-center cursor-pointer hover:border-[#1e3a5f]/40 hover:bg-gray-50 transition-all duration-200">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-700 mb-1">Upload Notes</p>
                <p class="text-xs text-gray-500 mb-3">
                    Drag and drop your PDF, Doc, or PPT files here, or
                    <label for="note_file" class="text-blue-600 font-semibold cursor-pointer hover:text-blue-800 transition-colors">browse</label>
                    to select files from your computer.
                </p>
                <input type="file" id="note_file" name="note_file"
                       accept=".pdf,.doc,.docx,.ppt,.pptx"
                       class="hidden">
                <p id="selected-filename" class="text-xs text-[#1e3a5f] font-semibold hidden"></p>
            </div>

            <div class="flex justify-end mt-3">
                <button type="submit" id="upload-btn"
                        class="hidden px-5 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                    Upload File
                </button>
            </div>
        </form>
    </div>

    {{-- Files Grid --}}
    @if($batch->batchNotes->isNotEmpty())
        <div class="grid grid-cols-3 gap-4">
            @foreach($batch->batchNotes as $note)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-start gap-3 hover:shadow-md transition-shadow group">

                    {{-- File Icon --}}
                    <div class="w-10 h-10 {{ $note->fileBgClass() }} rounded-lg flex items-center justify-center shrink-0">
                        @if(in_array(strtolower($note->file_type), ['pdf']))
                            <svg class="w-5 h-5 {{ $note->fileColorClass() }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        @elseif(in_array(strtolower($note->file_type), ['docx', 'doc']))
                            <svg class="w-5 h-5 {{ $note->fileColorClass() }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 {{ $note->fileColorClass() }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $note->original_filename }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ strtoupper($note->file_type) }} • {{ $note->formattedSize() }} • {{ $note->created_at->format('M d') }}
                        </p>
                        {{-- Actions (appear on hover) --}}
                        <div class="flex items-center gap-3 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('teacher.batches.notes.download', [$batch, $note]) }}"
                               class="text-xs text-blue-600 font-semibold hover:text-blue-800 transition-colors">Download</a>
                            <form method="POST" action="{{ route('teacher.batches.notes.destroy', [$batch, $note]) }}"
                                  onsubmit="return confirm('Delete this note?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 font-semibold hover:text-red-700 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Quick Add File card --}}
            <label for="note_file"
                   class="bg-white rounded-xl border-2 border-dashed border-gray-200 p-4 flex flex-col items-center justify-center cursor-pointer hover:border-[#1e3a5f]/30 hover:bg-gray-50 transition-all min-h-[88px]">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <p class="text-xs font-semibold text-gray-500">Quick Add File</p>
            </label>
        </div>
    @endif

    {{-- Repository Status Footer --}}
    <div class="mt-5 flex items-center justify-between px-1">
        <div class="flex items-center gap-2 text-xs text-gray-500">
            <div class="w-6 h-6 bg-[#1e3a5f] rounded-full flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <span class="font-semibold">Repository Status</span>
                <span class="text-gray-400 ml-1">
                    {{ $batch->batchNotes->count() }} file{{ $batch->batchNotes->count() !== 1 ? 's' : '' }} uploaded this session
                    •
                    {{ $batch->batchNotes->sum('file_size_kb') >= 1024
                        ? round($batch->batchNotes->sum('file_size_kb') / 1024, 1).' MB'
                        : $batch->batchNotes->sum('file_size_kb').' KB' }} total storage used
                </span>
            </div>
        </div>
        <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">Storage Settings</a>
    </div>
</div>

@push('scripts')
<script>
    // File input → show filename + reveal upload button
    const fileInput = document.getElementById('note_file');
    const filenameEl = document.getElementById('selected-filename');
    const uploadBtn = document.getElementById('upload-btn');
    const dropZone = document.getElementById('drop-zone');

    fileInput?.addEventListener('change', function() {
        if (this.files.length > 0) {
            filenameEl.textContent = '📎 ' + this.files[0].name;
            filenameEl.classList.remove('hidden');
            uploadBtn.classList.remove('hidden');
        }
    });

    // Drag and Drop
    dropZone?.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-[#1e3a5f]', 'bg-blue-50/50');
    });

    dropZone?.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-[#1e3a5f]', 'bg-blue-50/50');
    });

    dropZone?.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-[#1e3a5f]', 'bg-blue-50/50');
        const dt = e.dataTransfer;
        if (dt.files.length > 0) {
            // Assign to input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(dt.files[0]);
            fileInput.files = dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    dropZone?.addEventListener('click', (e) => {
        if (e.target.tagName !== 'LABEL') fileInput.click();
    });
</script>
@endpush
