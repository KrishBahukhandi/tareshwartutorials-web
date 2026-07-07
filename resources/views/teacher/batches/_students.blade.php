<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="font-bold text-gray-900">Student Roster</h3>
            <p class="text-xs text-gray-500 mt-0.5">{{ $batch->enrollments->where('status', 'active')->count() }} active enrollments</p>
        </div>
        <span class="text-xs font-bold text-[#1e3a5f] bg-blue-50 px-3 py-1 rounded-full">
            {{ $batch->availableSeats() }} seats left
        </span>
    </div>

    @forelse($batch->enrollments->where('status', 'active') as $enrollment)
        <div class="px-5 py-4 border-b border-gray-100 last:border-b-0 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <img src="{{ $enrollment->student->profilePhotoUrl() }}" alt="{{ $enrollment->student->name }}" class="w-10 h-10 rounded-full object-cover">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $enrollment->student->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $enrollment->student->email }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-bold text-[#1e3a5f]">{{ $enrollment->progress_percentage }}%</p>
                <p class="text-xs text-gray-400">Enrolled {{ $enrollment->enrollment_date->format('M d') }}</p>
            </div>
        </div>
    @empty
        <div class="p-12 text-center">
            <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-700 mb-1">No enrolled students yet</h3>
            <p class="text-sm text-gray-400">Students will appear here after they enroll in this batch.</p>
        </div>
    @endforelse
</div>
