@extends('layouts.admin')

@section('title', 'Academic Batches')
@section('search_placeholder', 'Global search...')

@section('content')
<div class="p-6">

    {{-- Page Header --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Academic Batches</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Oversee enrollment, schedules, and faculty assignments across
                <span class="font-semibold text-gray-700">{{ $batches->count() }} active cohorts.</span>
            </p>
        </div>
        <button id="open-modal-btn"
                class="flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] text-white rounded-lg text-sm font-semibold hover:bg-[#162d4a] transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Batch
        </button>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.batches.index') }}" id="filter-form">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5 flex items-end gap-3">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Filter by Grade</label>
                <div class="relative">
                    <select name="grade" onchange="document.getElementById('filter-form').submit()"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer pr-8">
                        <option value="">All Grades</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade }}" @selected(request('grade') === $grade)>{{ $grade }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Academic Subject</label>
                <div class="relative">
                    <select name="subject" onchange="document.getElementById('filter-form').submit()"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer pr-8">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject }}" @selected(request('subject') === $subject)>{{ $subject }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Lead Teacher</label>
                <div class="relative">
                    <select name="teacher_id" onchange="document.getElementById('filter-form').submit()"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer pr-8">
                        <option value="">All Faculty</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" @selected(request('teacher_id') == $teacher->id)>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.batches.index') }}"
               class="flex items-center gap-2 px-4 py-2.5 border border-gray-200 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-50 transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Reset Filters
            </a>
        </div>
    </form>

    {{-- Batch Cards Grid --}}
    @if($batches->isEmpty())
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm text-center py-20">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <p class="text-gray-500 font-medium">No batches found.</p>
            <p class="text-sm text-gray-400 mt-1">Click "Create Batch" to get started.</p>
        </div>
    @else
        <div class="grid grid-cols-3 gap-4">
            @foreach($batches as $batch)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-5">
                    <div class="flex items-start justify-between mb-3">
                        <span class="text-[11px] font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full uppercase tracking-wide">
                            {{ $batch->grade }} • {{ implode(', ', $batch->subjects->pluck('name')->toArray()) }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.batches.show', $batch) }}"
                               class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 transition-colors text-gray-500 hover:text-[#1e3a5f]" title="Manage Subjects & Teachers">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.batches.destroy', $batch) }}"
                                  onsubmit="return confirm('Delete batch {{ $batch->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-red-50 transition-colors text-gray-500 hover:text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-4 leading-tight">{{ $batch->name }}</h3>

                    <div class="border-t border-gray-100 pt-4 space-y-3">
                        <div class="flex items-start gap-2.5">
                            <div class="w-5 h-5 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-400 font-medium">Schedule</p>
                                <p class="text-xs font-semibold text-gray-700">{{ $batch->formattedSchedule() }}</p>
                            </div>
                        </div>

                        @if($batch->teachers->unique('id')->count() > 0)
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 h-5 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] text-gray-400 font-medium">Faculty</p>
                                    <p class="text-xs font-semibold text-gray-700">{{ $batch->teachers->unique('id')->count() }} Instructors</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-start gap-2.5">
                                <div class="w-5 h-5 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] text-orange-400 font-medium">Faculty</p>
                                    <p class="text-xs font-semibold text-orange-700">No Instructors Assigned</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-[11px] text-gray-400 font-medium mb-2">Enrollment</p>
                        <div class="flex items-center gap-1.5">
                            <div class="flex -space-x-1.5">
                                <div class="w-6 h-6 rounded-full bg-gray-200 border-2 border-white"></div>
                                <div class="w-6 h-6 rounded-full bg-gray-300 border-2 border-white"></div>
                            </div>
                            <span class="text-xs text-gray-400">0 / {{ $batch->student_limit }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

{{-- ===== CREATE BATCH MODAL ===== --}}
<div id="batch-modal"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">

    {{-- Backdrop --}}
    <div id="modal-backdrop"
         class="absolute inset-0 bg-[#1e3a5f]/40 backdrop-blur-sm transition-opacity duration-200"></div>

    {{-- Modal Panel --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 transform transition-all duration-200">

        {{-- Modal Header --}}
        <div class="px-6 pt-6 pb-4 border-b border-gray-100">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Create New Batch</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Set up a new academic cohort and schedule.</p>
                </div>
                <button id="close-modal-btn"
                        class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-gray-500 hover:text-gray-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Modal Form --}}
        <form method="POST" action="{{ route('admin.batches.store') }}" id="batch-form">
            @csrf
            <div class="px-6 py-5 space-y-4">

                {{-- Batch Name + Subject --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Batch Name</label>
                        <input type="text" name="name" placeholder="e.g. Physics B24-1"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Subjects</label>
                        <input type="text" name="subjects_input" placeholder="e.g. Physics, Chemistry, Maths"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition" required>
                        <p class="text-[10px] text-gray-400 mt-1">Comma-separated list</p>
                    </div>
                </div>

                {{-- Grade --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Class</label>
                    <div class="relative">
                        <select name="grade"
                                class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 bg-white appearance-none cursor-pointer pr-8 transition">
                            <option value="">Select Class</option>
                            <option value="Class 9">Class 9</option>
                            <option value="Class 10">Class 10</option>
                            <option value="Class 11">Class 11</option>
                            <option value="Class 12">Class 12</option>
                        </select>
                        <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Student Limit --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Student Limit</label>
                    <input type="number" name="student_limit" value="30" min="1" max="500"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>

                {{-- Class Schedule Days --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Class Schedule</label>
                    <div class="flex items-center gap-2 flex-wrap">
                        @foreach(['MON','TUE','WED','THU','FRI','SAT'] as $day)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="schedule_days[]" value="{{ $day }}" class="sr-only peer">
                                <span class="inline-block px-3.5 py-1.5 text-xs font-bold rounded-lg border border-gray-200 text-gray-600
                                             peer-checked:bg-[#1e3a5f] peer-checked:text-white peer-checked:border-[#1e3a5f]
                                             hover:border-[#1e3a5f]/40 transition-all duration-150 select-none">
                                    {{ $day }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Start/End Time --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">Start Time</label>
                        <input type="time" name="start_time" value="09:00"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-1.5">End Time</label>
                        <input type="time" name="end_time" value="11:00"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                    </div>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="px-6 py-4 bg-gray-50/70 rounded-b-2xl border-t border-gray-100 flex items-center justify-end gap-3">
                <button type="button" id="discard-btn"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors">
                    Discard
                </button>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                    Create Batch
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('batch-modal');
    const openBtn = document.getElementById('open-modal-btn');
    const closeBtn = document.getElementById('close-modal-btn');
    const discardBtn = document.getElementById('discard-btn');
    const backdrop = document.getElementById('modal-backdrop');

    function openModal() {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    discardBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);

    // Auto-open if URL has ?openModal=1
    if (new URLSearchParams(window.location.search).get('openModal') === '1') {
        openModal();
    }

    // Reopen if validation failed (form was submitted with errors)
    @if($errors->any())
        openModal();
    @endif
</script>
@endpush
