@extends('layouts.teacher')

@section('title', $batch->name)
@section('search_placeholder', 'Search batches, meetings, students...')

@section('content')
<div class="p-6">

    {{-- Back link --}}
    <a href="{{ route('teacher.dashboard') }}"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 mb-4 transition-colors group">
        <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Batches
    </a>

    {{-- Page Header --}}
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $batch->name }}</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                {{ $batch->grade }} • {{ $batch->subject }} • {{ $batch->student_limit }} Student Limit
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2.5 border border-gray-200 text-sm font-semibold text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Details
            </button>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
                Invite Students
            </button>
        </div>
    </div>

    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200 mb-6">
        <nav class="flex gap-0 -mb-px">
            @php
                $tabs = [
                    ['key' => 'overview',      'label' => 'Overview'],
                    ['key' => 'students',      'label' => 'Student Roster'],
                    ['key' => 'live_meeting',  'label' => 'Live Meetings'],
                    ['key' => 'lectures',      'label' => 'Lectures'],
                    ['key' => 'notes',         'label' => 'Notes'],
                    ['key' => 'assignments',   'label' => 'Assignments'],
                ];
            @endphp

            @foreach($tabs as $tabItem)
                @php
                    $href = $tabItem['key'] === 'assignments' 
                        ? route('teacher.batches.assignments.index', $batch)
                        : route('teacher.batches.show', ['batch' => $batch, 'tab' => $tabItem['key']]);
                @endphp
                <a href="{{ $href }}"
                   class="px-5 py-3 text-sm font-medium border-b-2 transition-colors
                          {{ $tab === $tabItem['key']
                              ? 'border-[#1e3a5f] text-[#1e3a5f]'
                              : 'border-transparent text-gray-500 hover:text-gray-800 hover:border-gray-300' }}">
                    {{ $tabItem['label'] }}
                </a>
            @endforeach
        </nav>
    </div>

    {{-- Tab Content --}}
    @if($tab === 'live_meeting')
        @include('teacher.batches._live_meetings')
    @elseif($tab === 'lectures')
        @include('teacher.batches._lectures')
    @elseif($tab === 'notes')
        @include('teacher.batches._notes')
    @elseif($tab === 'students')
        @include('teacher.batches._students')
    @else
        @include('teacher.batches._overview')
    @endif

</div>

{{-- Lecture Upload Modal --}}
<div id="lecture-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-[#1e3a5f]/40 backdrop-blur-sm" id="lecture-modal-backdrop"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
        <div class="px-6 pt-6 pb-4 border-b border-gray-100 flex items-start justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Upload New Lecture</h3>
                <p class="text-sm text-gray-500 mt-0.5">Add a recorded lecture video for your students.</p>
            </div>
            <button id="close-lecture-modal"
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-gray-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('teacher.batches.lectures.store', $batch) }}" id="lecture-form">
            @csrf
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Lecture Title</label>
                    <input type="text" name="title" placeholder="e.g. Introduction to Wave Mechanics"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Video URL
                        <span class="font-normal text-gray-400">(YouTube, Google Drive, Vimeo)</span>
                    </label>
                    <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=..."
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Duration
                        <span class="font-normal text-gray-400">(MM:SS or H:MM:SS)</span>
                    </label>
                    <input type="text" name="duration" placeholder="e.g. 45:12 or 1:04:15"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Description <span class="font-normal text-gray-400">(optional)</span></label>
                    <textarea name="description" rows="2" placeholder="Brief summary of what this lecture covers..."
                              class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 resize-none transition"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50/70 rounded-b-2xl border-t border-gray-100 flex justify-end gap-3">
                <button type="button" id="discard-lecture"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors">Discard</button>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                    Add Lecture
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Meeting Link Modal --}}
<div id="meeting-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-[#1e3a5f]/40 backdrop-blur-sm" id="meeting-modal-backdrop"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
        <div class="px-6 pt-6 pb-4 border-b border-gray-100 flex items-start justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">
                    {{ $batch->meeting_link ? 'Update Meeting Link' : 'Share Meeting Link' }}
                </h3>
                <p class="text-sm text-gray-500 mt-0.5">Students will be able to join via this link.</p>
            </div>
            <button id="close-meeting-modal"
                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors text-gray-500 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('teacher.batches.meeting.update', $batch) }}">
            @csrf
            @method('PUT')
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Session Title</label>
                    <input type="text" name="meeting_title"
                           value="{{ old('meeting_title', $batch->meeting_title) }}"
                           placeholder="e.g. Particle Duality & Wave Functions"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Google Meet Link</label>
                    <input type="url" name="meeting_link"
                           value="{{ old('meeting_link', $batch->meeting_link) }}"
                           placeholder="https://meet.google.com/abc-defg-hij"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 transition">
                    <p class="text-xs text-gray-400 mt-1">Paste your Google Meet link here. Students will see a "Join Meeting" button.</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Scheduled Date & Time <span class="font-normal text-gray-400">(optional)</span></label>
                    <input type="datetime-local" name="meeting_scheduled_at"
                           value="{{ old('meeting_scheduled_at', $batch->meeting_scheduled_at?->format('Y-m-d\TH:i')) }}"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 transition">
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50/70 rounded-b-2xl border-t border-gray-100 flex justify-end gap-3">
                <button type="button" id="discard-meeting"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors">Cancel</button>
                <button type="submit"
                        class="px-6 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                    {{ $batch->meeting_link ? 'Update Link' : 'Share Link' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ─── Lecture Modal ───────────────────────────────────────────────────────
    const lectureModal = document.getElementById('lecture-modal');
    const openLectureBtn = document.getElementById('open-lecture-modal');
    const closeLectureBtn = document.getElementById('close-lecture-modal');
    const discardLectureBtn = document.getElementById('discard-lecture');
    const lectureMBackdrop = document.getElementById('lecture-modal-backdrop');

    function openLectureModal() { lectureModal?.classList.remove('hidden'); }
    function closeLectureModal() { lectureModal?.classList.add('hidden'); }

    openLectureBtn?.addEventListener('click', openLectureModal);
    closeLectureBtn?.addEventListener('click', closeLectureModal);
    discardLectureBtn?.addEventListener('click', closeLectureModal);
    lectureMBackdrop?.addEventListener('click', closeLectureModal);

    // ─── Meeting Modal ───────────────────────────────────────────────────────
    const meetingModal = document.getElementById('meeting-modal');
    const openMeetingBtns = document.querySelectorAll('.open-meeting-modal');
    const closeMeetingBtn = document.getElementById('close-meeting-modal');
    const discardMeetingBtn = document.getElementById('discard-meeting');
    const meetingBackdrop = document.getElementById('meeting-modal-backdrop');

    function openMeetingModal() { meetingModal?.classList.remove('hidden'); }
    function closeMeetingModal() { meetingModal?.classList.add('hidden'); }

    openMeetingBtns.forEach(btn => btn.addEventListener('click', openMeetingModal));
    closeMeetingBtn?.addEventListener('click', closeMeetingModal);
    discardMeetingBtn?.addEventListener('click', closeMeetingModal);
    meetingBackdrop?.addEventListener('click', closeMeetingModal);

    // ─── Countdown Timer ─────────────────────────────────────────────────────
    const countdownEl = document.getElementById('meeting-countdown');
    if (countdownEl) {
        const targetTime = new Date(countdownEl.dataset.target).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const diff = targetTime - now;

            if (diff <= 0) {
                document.getElementById('cd-hrs').textContent = '00';
                document.getElementById('cd-min').textContent = '00';
                document.getElementById('cd-sec').textContent = '00';
                return;
            }

            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('cd-hrs').textContent = String(hours).padStart(2, '0');
            document.getElementById('cd-min').textContent = String(minutes).padStart(2, '0');
            document.getElementById('cd-sec').textContent = String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    // ─── Reopen modals on validation errors ──────────────────────────────────
    @if($errors->any() && old('video_url'))
        openLectureModal();
    @endif
    @if($errors->any() && old('meeting_link'))
        openMeetingModal();
    @endif
</script>
@endpush
