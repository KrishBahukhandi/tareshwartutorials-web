@extends('layouts.teacher')

@section('title', 'My Batches')
@section('search_placeholder', 'Search batches, students...')

@section('content')
<div class="p-6">

    {{-- Breadcrumb + Header --}}
    <div class="mb-5">
        <nav class="text-xs text-gray-400 mb-1">
            <span>Dashboard</span>
            <span class="mx-1">›</span>
            <span class="text-gray-700 font-medium">My Batches</span>
        </nav>
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Academic Batches</h1>
                <p class="text-sm text-gray-500 mt-0.5">Oversee your active course enrollments and schedules.</p>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex items-center gap-1.5 px-3 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Grid
                </button>
                <button class="flex items-center gap-1.5 px-3 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    List
                </button>
                <button class="flex items-center gap-1.5 px-3 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
            </div>
        </div>
    </div>

    @if($batches->isEmpty())
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm text-center py-20">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-gray-500 font-medium">No batches assigned yet.</p>
            <p class="text-sm text-gray-400 mt-1">Contact your administrator to get batches assigned to you.</p>
        </div>
    @else

        {{-- Batch Cards Grid --}}
        <div class="grid grid-cols-3 gap-4 mb-5">
            @foreach($batches as $batch)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200 p-5 flex flex-col">

                    {{-- Card Top: Subject Icon + Status Badge --}}
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-[#1e3a5f]/8 flex items-center justify-center">
                            @php
                                $subjStr = strtolower(implode(' ', $batch->subjects->pluck('name')->toArray()));
                            @endphp
                            @if(str_contains($subjStr, 'math') || str_contains($subjStr, 'calculus'))
                                <span class="material-symbols-outlined text-[20px] text-[#1e3a5f] opacity-80">functions</span>
                            @elseif(str_contains($subjStr, 'physics') || str_contains($subjStr, 'science'))
                                <svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            @endif
                        </div>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide
                                     {{ $batch->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $batch->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    {{-- Batch Name + Code --}}
                    <h3 class="text-base font-bold text-gray-900 leading-snug mb-0.5">{{ $batch->name }}</h3>
                    <p class="text-xs text-gray-500 mb-4">{{ implode(', ', $batch->subjects->pluck('name')->toArray()) }} • {{ $batch->grade }}</p>

                    {{-- Stats Row --}}
                    <div class="flex items-center justify-between mb-3 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-xs text-gray-600 font-medium">{{ $batch->enrollments_count }} Students</span>
                        </div>
                        {{-- Avatar placeholders --}}
                        <div class="flex -space-x-1.5">
                            <div class="w-5 h-5 rounded-full bg-gray-200 border-2 border-white"></div>
                            <div class="w-5 h-5 rounded-full bg-gray-300 border-2 border-white"></div>
                        </div>
                    </div>

                    {{-- Next Class --}}
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs text-gray-600">
                            Next: <span class="font-semibold text-gray-800">{{ $batch->nextClassForHumans() }}</span>
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 mt-auto">
                        <a href="{{ route('teacher.batches.show', $batch) }}"
                           class="flex-1 py-2.5 bg-[#1e3a5f] text-white text-xs font-bold text-center rounded-lg hover:bg-[#162d4a] transition-colors">
                            Enter Classroom
                        </a>
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-gray-500"
                                title="More options">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>



    @endif

</div>
@endsection
