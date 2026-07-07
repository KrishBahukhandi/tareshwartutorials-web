@extends('layouts.student')

@section('title', 'My Enrollments')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <section class="rounded-[2rem] bg-[#101828] p-6 text-white sm:p-8">
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.18em] text-emerald-200">Learning Programs</p>
                <h1 class="mt-3 text-3xl font-black sm:text-4xl">My Enrollments</h1>
                <p class="mt-3 max-w-2xl text-sm font-medium leading-6 text-gray-300">Your active batches with teacher, schedule, and progress details.</p>
            </div>
            <a href="{{ route('batches.index') }}" class="inline-flex justify-center rounded-2xl bg-white px-5 py-3 text-sm font-black text-[#101828] hover:bg-gray-100">Explore More</a>
        </div>
    </section>

    <section class="mt-6">
        <div class="grid gap-4">
            @forelse($enrollments as $enrollment)
                @php($batch = $enrollment->batch)
                <article class="rounded-[2rem] border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_260px] lg:items-center">
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-black uppercase text-emerald-700">{{ $enrollment->status }}</span>
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-black text-gray-500">Enrolled {{ $enrollment->enrollment_date->format('M d, Y') }}</span>
                            </div>
                            <h2 class="mt-3 text-xl font-black text-gray-950">{{ $batch->name }}</h2>
                            <p class="mt-1 text-sm font-semibold text-gray-500">{{ $batch->subjects->count() ? implode(', ', $batch->subjects->pluck('name')->toArray()) : 'Multiple Subjects' }} - {{ $batch->grade }} - {{ $batch->teachers->count() ? implode(', ', $batch->teachers->unique('id')->pluck('name')->toArray()) : 'Teacher TBA' }}</p>
                            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl bg-gray-50 p-3">
                                    <p class="text-xs font-bold text-gray-400">Schedule</p>
                                    <p class="mt-1 text-sm font-black text-gray-800">{{ $batch->formattedSchedule() }}</p>
                                </div>
                                <div class="rounded-2xl bg-gray-50 p-3">
                                    <p class="text-xs font-bold text-gray-400">Next class</p>
                                    <p class="mt-1 text-sm font-black text-gray-800">{{ $batch->nextClassForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="rounded-3xl bg-[#eef7f1] p-4">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-black uppercase tracking-[0.16em] text-emerald-700">Progress</span>
                                    <span class="font-black text-gray-950">{{ $enrollment->progress_percentage }}%</span>
                                </div>
                                <div class="mt-3 h-3 overflow-hidden rounded-full bg-white">
                                    <div class="h-full rounded-full bg-emerald-500" style="width: {{ $enrollment->progress_percentage }}%"></div>
                                </div>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <a href="{{ route('batches.show', $batch) }}" class="inline-flex flex-1 justify-center rounded-2xl bg-[#101828] px-4 py-3 text-sm font-black text-white hover:bg-gray-800">Open</a>
                                @if($batch->meeting_link)
                                    <a href="{{ $batch->meeting_link }}" target="_blank" class="inline-flex flex-1 justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-black text-white hover:bg-emerald-700">Join</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-[2rem] border border-gray-200 bg-white p-10 text-center shadow-sm">
                    <h2 class="text-xl font-black text-gray-950">No active enrollments</h2>
                    <p class="mt-2 text-sm font-semibold text-gray-500">Browse available batches and enroll in your first program.</p>
                    <a href="{{ route('batches.index') }}" class="mt-5 inline-flex rounded-2xl bg-[#101828] px-5 py-3 text-sm font-black text-white">Browse Batches</a>
                </div>
            @endforelse
        </div>

        @if($enrollments->hasPages())
            <div class="mt-6">
                {{ $enrollments->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
