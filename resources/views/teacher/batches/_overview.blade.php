{{-- Overview Tab --}}
<div class="grid grid-cols-3 gap-5">

    <div class="col-span-2 space-y-4">
        {{-- Batch Info Card --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h3 class="text-sm font-bold text-gray-800 mb-4">Batch Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Subject</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $batch->subjectNames() }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Grade</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $batch->grade }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Schedule</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $batch->formattedSchedule() }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Student Limit</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $batch->student_limit }} students</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Status</p>
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full
                                 {{ $batch->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $batch->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                        {{ $batch->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Next Class</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $batch->nextClassForHumans() }}</p>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="grid grid-cols-3 gap-3">
            <a href="{{ route('teacher.batches.show', ['batch' => $batch, 'tab' => 'live_meeting']) }}"
               class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 text-center hover:shadow-md hover:border-[#1e3a5f]/20 transition-all group">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.069A1 1 0 0121 8.829v6.342a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-700">Live Meeting</p>
                <p class="text-[11px] text-gray-400 mt-0.5">{{ $batch->meeting_link ? 'Link Set' : 'Not Set' }}</p>
            </a>

            <a href="{{ route('teacher.batches.show', ['batch' => $batch, 'tab' => 'lectures']) }}"
               class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 text-center hover:shadow-md hover:border-[#1e3a5f]/20 transition-all group">
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-purple-100 transition-colors">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-700">Lectures</p>
                <p class="text-[11px] text-gray-400 mt-0.5">{{ $batch->lectures->count() }} uploaded</p>
            </a>

            <a href="{{ route('teacher.batches.show', ['batch' => $batch, 'tab' => 'notes']) }}"
               class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 text-center hover:shadow-md hover:border-[#1e3a5f]/20 transition-all group">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-700">Notes</p>
                <p class="text-[11px] text-gray-400 mt-0.5">{{ $batch->batchNotes->count() }} files</p>
            </a>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="space-y-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Batch Summary</p>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-600">Total Lectures</span>
                    <span class="text-sm font-bold text-gray-900">{{ $batch->lectures->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-600">Study Notes</span>
                    <span class="text-sm font-bold text-gray-900">{{ $batch->batchNotes->count() }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-600">Live Meeting</span>
                    <span class="text-sm font-bold {{ $batch->meeting_link ? 'text-emerald-600' : 'text-gray-400' }}">
                        {{ $batch->meeting_link ? 'Linked' : 'Not set' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
