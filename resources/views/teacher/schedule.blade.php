@extends('layouts.teacher')

@section('title', 'Schedule')

@section('content')
<div class="p-6">
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Your Schedule</h1>
            <p class="text-sm text-gray-500 mt-1">View and manage your upcoming classes and meetings.</p>
        </div>
        <div class="flex gap-2">
            <button class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Today
            </button>
            <div class="flex rounded-lg border border-gray-200 overflow-hidden">
                <button class="bg-gray-100 text-gray-700 px-3 py-2 text-sm font-medium">Day</button>
                <button class="bg-white hover:bg-gray-50 text-gray-700 px-3 py-2 text-sm font-medium border-l border-gray-200">Week</button>
            </div>
        </div>
    </div>

    @if($batches->isEmpty())
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center py-20">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">No Batches Assigned</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6">You currently have no batches assigned to you to display a schedule.</p>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="divide-y divide-gray-100">
                @foreach($batches as $batch)
                <div class="p-6 hover:bg-gray-50 transition-colors flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-xl bg-blue-50 flex flex-col items-center justify-center border border-blue-100 shrink-0">
                            <span class="text-xs font-bold text-blue-600 uppercase">{{ Str::limit($batch->subject, 3, '') }}</span>
                            <span class="text-sm font-black text-[#1e3a5f] mt-0.5">G{{ $batch->grade }}</span>
                        </div>
                        <div>
                            <a href="{{ route('teacher.batches.show', $batch) }}" class="text-lg font-bold text-[#1e3a5f] hover:underline">{{ $batch->name }}</a>
                            <div class="flex items-center gap-4 mt-2">
                                <div class="flex items-center gap-1.5 text-sm font-medium text-gray-700 bg-gray-100 px-3 py-1 rounded-full">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $batch->formattedSchedule() }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    Next class: <span class="font-bold text-gray-900">{{ $batch->nextClassForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if($batch->meeting_link)
                            <a href="{{ $batch->meeting_link }}" target="_blank" class="bg-green-50 text-green-700 hover:bg-green-100 px-4 py-2 rounded-lg text-sm font-bold transition-colors inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                Join Room
                            </a>
                        @else
                            <span class="bg-gray-100 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Offline Centre
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
