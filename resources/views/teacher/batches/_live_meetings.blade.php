{{-- Live Meetings Tab --}}
<div class="grid grid-cols-3 gap-5">

    {{-- Main Column --}}
    <div class="col-span-2 space-y-5">

        {{-- Upcoming Session Card --}}
        @if($batch->meeting_link)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start gap-3">
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full uppercase tracking-wide">
                            Upcoming Next
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="text-[11px] text-gray-400 mb-1">Next class in</p>
                        @php
                            $targetTime = $batch->meeting_scheduled_at
                                ? $batch->meeting_scheduled_at
                                : $batch->nextClassAt();
                        @endphp
                        @if($targetTime)
                            <div id="meeting-countdown" data-target="{{ $targetTime->toIso8601String() }}"
                                 class="flex items-center gap-2">
                                <div class="text-center">
                                    <p id="cd-hrs" class="text-2xl font-black text-gray-900 leading-none">00</p>
                                    <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-0.5">HRS</p>
                                </div>
                                <p class="text-xl font-black text-gray-300">:</p>
                                <div class="text-center">
                                    <p id="cd-min" class="text-2xl font-black text-gray-900 leading-none">00</p>
                                    <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-0.5">MIN</p>
                                </div>
                                <p class="text-xl font-black text-gray-300">:</p>
                                <div class="text-center">
                                    <p id="cd-sec" class="text-2xl font-black text-gray-900 leading-none">00</p>
                                    <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-0.5">SEC</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <h2 class="text-lg font-bold text-gray-900 mb-0.5">{{ $batch->meeting_title }}</h2>
                @if($batch->meeting_scheduled_at)
                    <p class="text-sm text-gray-500 mb-4">
                        Scheduled for {{ $batch->meeting_scheduled_at->format('l, g:i A') }}
                        – {{ $batch->meeting_scheduled_at->addHours(1)->format('g:i A') }}
                    </p>
                @else
                    <p class="text-sm text-gray-500 mb-4">{{ $batch->formattedSchedule() }}</p>
                @endif

                {{-- Meeting Link Box --}}
                <div class="border border-gray-200 rounded-xl p-4">
                    <p class="text-xs font-semibold text-gray-500 mb-3">Meeting Link (Google Meet)</p>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2.5 overflow-hidden">
                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            <span class="text-sm text-gray-700 truncate font-mono">{{ $batch->meeting_link }}</span>
                        </div>
                        <a href="{{ $batch->meeting_link }}" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] text-white text-sm font-bold rounded-lg hover:bg-[#162d4a] transition-colors shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.069A1 1 0 0121 8.829v6.342a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Join Now
                        </a>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center gap-1.5 text-xs text-emerald-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Link shared with all enrolled students
                        </div>
                        <button class="open-meeting-modal text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1">
                            Update Link
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @else
            {{-- No meeting link yet --}}
            <div class="bg-white rounded-xl border-2 border-dashed border-gray-200 p-8 text-center">
                <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.069A1 1 0 0121 8.829v6.342a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 mb-1">No Meeting Link Yet</h3>
                <p class="text-sm text-gray-500 mb-4">Share a Google Meet link so students can join your live session.</p>
                <button class="open-meeting-modal px-5 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors">
                    Share Google Meet Link
                </button>
            </div>
        @endif

        {{-- Recent Class Recordings --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-gray-900">Recent Class Recordings</h3>
                <a href="{{ route('teacher.batches.show', ['batch' => $batch, 'tab' => 'lectures']) }}"
                   class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                    View All Archive →
                </a>
            </div>

            @if($batch->lectures->isEmpty())
                <p class="text-sm text-gray-400 text-center py-6">No recorded lectures yet. Upload your first lecture in the Lectures tab.</p>
            @else
                <div class="space-y-3">
                    @foreach($batch->lectures->take(3) as $lecture)
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $lecture->title }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $lecture->created_at->format('M d, Y') }}
                                    • {{ $lecture->duration }}
                                    • {{ number_format($lecture->views_count) }} views
                                </p>
                            </div>
                            <a href="{{ $lecture->video_url }}" target="_blank"
                               class="text-[#1e3a5f] opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Right Sidebar --}}
    <div class="space-y-4">

        {{-- Participation Stats --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4">Participation Stats</p>
            <div class="space-y-3">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs text-gray-600">Avg. Attendance</span>
                        <span class="text-xs font-bold text-gray-800">92%</span>
                    </div>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-[#1e3a5f] rounded-full" style="width: 92%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs text-gray-600">Class Engagement</span>
                        <span class="text-xs font-bold text-gray-800">78%</span>
                    </div>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-400 rounded-full" style="width: 78%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Meeting Handouts --}}
        <div class="bg-[#1e3a5f] rounded-xl p-5 text-white">
            <p class="text-[11px] font-bold uppercase tracking-widest text-blue-200 mb-1">Meeting Handouts</p>
            <p class="text-xs text-blue-200 mb-4 leading-relaxed">Ensure students have these documents open before starting the live session.</p>

            @if($batch->batchNotes->isEmpty())
                <p class="text-xs text-blue-300/60 text-center py-2">No notes uploaded yet.</p>
            @else
                <div class="space-y-2 mb-3">
                    @foreach($batch->batchNotes->take(2) as $note)
                        <div class="flex items-center gap-2 bg-white/10 rounded-lg px-3 py-2">
                            <svg class="w-3.5 h-3.5 text-blue-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-xs text-white truncate">{{ $note->original_filename }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <a href="{{ route('teacher.batches.show', ['batch' => $batch, 'tab' => 'notes']) }}"
               class="block w-full text-center py-2 bg-white text-[#1e3a5f] text-xs font-bold rounded-lg hover:bg-blue-50 transition-colors">
                {{ $batch->batchNotes->isEmpty() ? 'Upload Notes' : 'Add New Resource' }}
            </a>
        </div>

    </div>
</div>
