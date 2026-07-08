@extends('layouts.admin')

@section('title', 'Upload Resource')

@section('content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.resources.index') }}" class="text-gray-400 hover:text-[#1e3a5f] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-[#1e3a5f]">Upload Free Resource</h1>
            <p class="text-sm text-gray-500">Add a note or PYQ to the public library</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">
        @if($errors->any())
            <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.resources.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="space-y-5">

                {{-- Type --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Resource Type</label>
                    <div class="flex gap-3">
                        @foreach(['note' => '📄 Notes', 'pyq' => '📝 PYQs', 'assignment' => '🎓 Assignments'] as $val => $label)
                            <label class="flex-1 border-2 rounded-xl p-3 cursor-pointer transition-all
                                          {{ old('type', 'note') === $val ? 'border-[#1e3a5f] bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                <input type="radio" name="type" value="{{ $val }}" class="sr-only"
                                       {{ old('type', 'note') === $val ? 'checked' : '' }}
                                       onchange="toggleType(this.value)">
                                <span class="text-sm font-semibold text-[#1e3a5f]">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Class & Subject --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="class_level">Class</label>
                        <select id="class_level" name="class_level" onchange="updateSubjects(this.value)"
                                class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10 @error('class_level') border-red-300 @enderror">
                            <option value="">Select class</option>
                            @foreach(['10', '11', '12'] as $cls)
                                <option value="{{ $cls }}" {{ old('class_level') === $cls ? 'selected' : '' }}>Class {{ $cls }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="subject">Subject</label>
                        <select id="subject" name="subject"
                                class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10 @error('subject') border-red-300 @enderror">
                            <option value="">Select class first</option>
                        </select>
                    </div>
                </div>

                {{-- Title --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           placeholder="e.g. Chapter 1 — Chemical Reactions and Equations"
                           class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10 @error('title') border-red-300 @enderror">
                </div>

                {{-- Chapter / Description --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="chapter">Chapter / Topic (optional)</label>
                        <input type="text" id="chapter" name="chapter" value="{{ old('chapter') }}"
                               placeholder="e.g. Chapter 1"
                               class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="board">Board (optional)</label>
                        <select id="board" name="board"
                                class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10">
                            <option value="NCERT" {{ old('board', 'NCERT') === 'NCERT' ? 'selected' : '' }}>NCERT</option>
                            <option value="CBSE" {{ old('board') === 'CBSE' ? 'selected' : '' }}>CBSE</option>
                            <option value="ICSE" {{ old('board') === 'ICSE' ? 'selected' : '' }}>ICSE</option>
                            <option value="State Board" {{ old('board') === 'State Board' ? 'selected' : '' }}>State Board</option>
                        </select>
                    </div>
                </div>

                {{-- PYQ Year (shown only for PYQ type) --}}
                <div id="year-field" class="hidden">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="year">Exam Year</label>
                    <input type="number" id="year" name="year" value="{{ old('year') }}"
                           min="2000" max="{{ date('Y') }}" placeholder="e.g. 2024"
                           class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="description">Short Description (optional)</label>
                    <textarea id="description" name="description" rows="2"
                              placeholder="Brief description of what this resource covers..."
                              class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:outline-none focus:border-[#1e3a5f] focus:ring-2 focus:ring-[#1e3a5f]/10">{{ old('description') }}</textarea>
                </div>

                {{-- PDF Upload --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">PDF File</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-[#1e3a5f]/40 transition-colors cursor-pointer"
                         onclick="document.getElementById('file').click()">
                        <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-gray-500" id="file-label">Click to select a PDF (max 20 MB)</p>
                        <input type="file" id="file" name="file" accept=".pdf" class="sr-only"
                               onchange="document.getElementById('file-label').textContent = this.files[0]?.name ?? 'Click to select a PDF'">
                    </div>
                    @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Publish toggle --}}
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" id="is_published" name="is_published" value="1" checked
                           class="w-4 h-4 rounded border-gray-300 text-[#1e3a5f] focus:ring-[#1e3a5f]/20 cursor-pointer">
                    <label for="is_published" class="text-sm text-gray-600 cursor-pointer">
                        Publish immediately (visible to public)
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3 mt-7 pt-5 border-t border-gray-100">
                <button type="submit"
                        class="px-6 py-3 bg-[#1e3a5f] text-white font-semibold text-sm rounded-xl hover:bg-[#162d4a] transition-colors">
                    Upload Resource
                </button>
                <a href="{{ route('admin.resources.index') }}"
                   class="px-6 py-3 border border-gray-200 text-gray-600 font-semibold text-sm rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
const subjectsByClass = @json(\App\Models\FreeResource::ncertSubjectsByClass());

function updateSubjects(cls) {
    const select = document.getElementById('subject');
    select.innerHTML = '<option value="">Select subject</option>';
    if (!cls || !subjectsByClass[cls]) return;

    const groups = subjectsByClass[cls];
    for (const [group, subjects] of Object.entries(groups)) {
        const optgroup = document.createElement('optgroup');
        optgroup.label = group;
        subjects.forEach(sub => {
            const opt = document.createElement('option');
            opt.value = sub;
            opt.textContent = sub;
            @if(old('subject'))
            if (sub === '{{ old('subject') }}') opt.selected = true;
            @endif
            optgroup.appendChild(opt);
        });
        select.appendChild(optgroup);
    }
}

function toggleType(val) {
    document.getElementById('year-field').classList.toggle('hidden', val !== 'pyq');
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        const label = radio.closest('label');
        label.classList.toggle('border-[#1e3a5f]', radio.value === val);
        label.classList.toggle('bg-blue-50', radio.value === val);
        label.classList.toggle('border-gray-200', radio.value !== val);
    });
}

// Init on load if old values exist
@if(old('class_level'))
    updateSubjects('{{ old('class_level') }}');
@endif
@if(old('type') === 'pyq')
    toggleType('pyq');
@endif
</script>
@endsection
