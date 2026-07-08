@extends('layouts.teacher')

@section('title', 'Overview')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Educator Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Welcome back! Here's an overview of your academic activities.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="text-sm font-medium text-gray-500 mb-1">Total Students</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_students']) }}</div>
            <div class="text-xs text-gray-500 mt-1">Across all your batches</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="text-sm font-medium text-gray-500 mb-1">Active Batches</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_batches']) }}</div>
            <div class="text-xs text-gray-500 mt-1">Currently assigned to you</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="text-sm font-medium text-gray-500 mb-1">Total Lectures</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_lectures']) }}</div>
            <div class="text-xs text-gray-500 mt-1">Uploaded across all batches</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="text-sm font-medium text-gray-500 mb-1">Global Notes</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_notes']) }}</div>
            <div class="text-xs text-green-600 mt-1 flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                Available to your students
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 space-y-6">
            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-bold text-gray-900 mb-4">Quick Actions</h3>
                <div class="flex gap-3">
                    <a href="{{ route('teacher.schedule') }}" class="flex items-center justify-center gap-2 flex-1 bg-[#1e3a5f] hover:bg-[#162d4a] text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Schedule
                    </a>
                    <a href="{{ route('teacher.resources') }}" class="flex items-center justify-center gap-2 flex-1 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Upload Material
                    </a>
                    <a href="{{ route('teacher.batches.index') }}" class="flex items-center justify-center gap-2 flex-1 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        My Batches
                    </a>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-bold text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    @forelse($recentLectures as $lecture)
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800">You uploaded <strong>{{ $lecture->title }}</strong> to <span class="font-medium text-[#1e3a5f]">{{ $lecture->batch->name }}</span>.</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $lecture->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic">No recent activity.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Upcoming Schedule --}}
        <div class="col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm h-full">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900">Today's Schedule</h3>
                    <a href="{{ route('teacher.schedule') }}" class="text-xs font-medium text-[#1e3a5f] hover:underline">View Calendar</a>
                </div>
                
                <div class="space-y-3">
                    @forelse($batches->take(4) as $batch)
                        <div class="p-3 border border-gray-100 rounded-lg {{ $loop->index % 2 == 0 ? 'bg-gray-50 border-l-4 border-l-[#1e3a5f]' : 'border-l-4 border-l-gray-300' }}">
                            <p class="text-xs font-bold text-gray-500 mb-1">{{ $batch->formattedSchedule() }}</p>
                            <p class="text-sm font-bold text-gray-900">{{ $batch->name }}</p>
                            <p class="text-xs text-gray-600 mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                {{ $batch->meeting_link ? 'Live Meeting Available' : 'Offline Centre' }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic">No batches assigned yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
