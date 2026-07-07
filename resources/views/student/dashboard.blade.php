@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
@php
    $activeEnrollments = $enrollments->where('status', 'active');
    $primaryEnrollment = $activeEnrollments->first() ?? $enrollments->first();
    $primaryBatch = $primaryEnrollment?->batch;
    $nextClass = $activeEnrollments
        ->map(fn ($enrollment) => ['enrollment' => $enrollment, 'next' => $enrollment->batch->nextClassAt()])
        ->filter(fn ($item) => $item['next'])
        ->sortBy('next')
        ->first();
@endphp

<div class="px-4 py-6 sm:px-6 lg:px-8">
    <section class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_360px]">
        <div class="overflow-hidden rounded-[2rem] bg-[#101828] text-white shadow-sm">
            <div class="grid min-h-[300px] lg:grid-cols-[minmax(0,1fr)_330px]">
                <div class="flex flex-col justify-between gap-8 p-6 sm:p-8">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-black uppercase tracking-[0.18em] text-emerald-200">Live Learning</span>
                            <span class="rounded-full bg-amber-300 px-3 py-1 text-xs font-black text-gray-950">Class {{ auth()->user()->class_level ?? '10-12' }}</span>
                        </div>
                        <h1 class="mt-5 max-w-3xl text-3xl font-black leading-tight sm:text-4xl lg:text-5xl">
                            Keep moving, {{ Str::of(auth()->user()->name)->before(' ') }}.
                        </h1>
                        <p class="mt-4 max-w-2xl text-sm font-medium leading-6 text-gray-300 sm:text-base">
                            Your enrolled batches, live class schedule, notes, and progress are all in one place.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-3xl bg-white/10 p-4">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-300">Enrolled</p>
                            <p class="mt-2 text-3xl font-black">{{ $stats['total_enrolled'] }}</p>
                        </div>
                        <div class="rounded-3xl bg-white/10 p-4">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-300">Active</p>
                            <p class="mt-2 text-3xl font-black">{{ $stats['active_batches'] }}</p>
                        </div>
                        <div class="rounded-3xl bg-white/10 p-4">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-gray-300">Progress</p>
                            <p class="mt-2 text-3xl font-black">{{ $stats['average_progress'] }}%</p>
                        </div>
                    </div>
                </div>

                <div class="relative hidden border-l border-white/10 bg-white/5 p-6 lg:block">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=700&q=80"
                         alt="Students learning together"
                         class="h-full min-h-[260px] w-full rounded-[1.5rem] object-cover">
                    <div class="absolute bottom-10 left-10 right-10 rounded-3xl bg-white p-4 text-gray-950 shadow-xl">
                        <p class="text-xs font-black uppercase tracking-[0.16em] text-gray-400">Next Focus</p>
                        <p class="mt-1 text-sm font-black">{{ $primaryBatch?->name ?? 'Explore your first batch' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <aside class="rounded-[2rem] border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black text-gray-950">Today</h2>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-black text-gray-500">{{ now()->format('M d') }}</span>
            </div>

            @if($nextClass)
                @php($nextEnrollment = $nextClass['enrollment'])
                @php($nextBatch = $nextEnrollment->batch)
                <div class="mt-5 rounded-3xl bg-[#eef7f1] p-4">
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-emerald-700">Upcoming Class</p>
                    <h3 class="mt-2 text-base font-black text-gray-950">{{ $nextBatch->name }}</h3>
                    <p class="mt-1 text-sm font-semibold text-gray-600">{{ $nextClass['next']->format('D, M d - g:i A') }}</p>
                    @if($nextBatch->meeting_link)
                        <a href="{{ $nextBatch->meeting_link }}" target="_blank" class="mt-4 inline-flex w-full justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-black text-white hover:bg-emerald-700">Join Live Class</a>
                    @else
                        <a href="{{ route('batches.show', $nextBatch) }}" class="mt-4 inline-flex w-full justify-center rounded-2xl bg-[#101828] px-4 py-3 text-sm font-black text-white hover:bg-gray-800">View Batch</a>
                    @endif
                </div>
            @else
                <div class="mt-5 rounded-3xl bg-gray-50 p-4">
                    <p class="text-sm font-semibold text-gray-600">No upcoming class is scheduled yet.</p>
                    <a href="{{ route('batches.index') }}" class="mt-4 inline-flex w-full justify-center rounded-2xl bg-[#101828] px-4 py-3 text-sm font-black text-white">Browse Batches</a>
                </div>
            @endif

            <div class="mt-5 grid gap-3">
                <a href="{{ route('batches.index') }}" class="flex items-center justify-between rounded-2xl border border-gray-200 px-4 py-3 text-sm font-black text-gray-800 hover:bg-gray-50">
                    Browse courses
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                </a>
                <a href="{{ route('notes.index') }}" class="flex items-center justify-between rounded-2xl border border-gray-200 px-4 py-3 text-sm font-black text-gray-800 hover:bg-gray-50">
                    Free NCERT notes
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                </a>
            </div>
        </aside>
    </section>

    <section class="mt-6 grid gap-5 xl:grid-cols-[minmax(0,1fr)_360px]">
        <div>
            <div class="mb-4 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-950">My Batches</h2>
                    <p class="text-sm font-medium text-gray-500">Continue from your active learning programs.</p>
                </div>
                <a href="{{ route('student.enrollments.index') }}" class="hidden rounded-2xl border border-gray-200 px-4 py-2 text-sm font-black text-gray-700 hover:bg-white sm:inline-flex">View all</a>
            </div>

            @if($enrollments->isEmpty())
                <div class="rounded-[2rem] border border-gray-200 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto grid h-16 w-16 place-items-center rounded-3xl bg-[#eef7f1] text-emerald-700">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253M12 6.253C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="mt-4 text-xl font-black text-gray-950">Start with your first batch</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm font-medium text-gray-500">Pick a course for your class and subject to unlock live classes, lectures, and study material.</p>
                    <a href="{{ route('batches.index') }}" class="mt-6 inline-flex rounded-2xl bg-[#101828] px-5 py-3 text-sm font-black text-white hover:bg-gray-800">Explore Batches</a>
                </div>
            @else
                <div class="grid gap-5 lg:grid-cols-2">
                    @foreach($enrollments as $enrollment)
                        @php($batch = $enrollment->batch)
                        <article class="overflow-hidden rounded-[2rem] border border-gray-200 bg-white shadow-sm">
                            <div class="h-2 bg-gradient-to-r from-emerald-400 via-sky-400 to-amber-300"></div>
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-black uppercase {{ $enrollment->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">{{ $enrollment->status }}</span>
                                        <h3 class="mt-3 text-xl font-black leading-6 text-gray-950">{{ $batch->name }}</h3>
                                        <p class="mt-1 text-sm font-semibold text-gray-500">{{ $batch->subject }} - {{ $batch->grade }}</p>
                                    </div>
                                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-[#101828] text-sm font-black text-white">
                                        {{ Str::substr($batch->subject, 0, 1) }}
                                    </div>
                                </div>

                                <div class="mt-5 grid grid-cols-2 gap-3">
                                    <div class="rounded-2xl bg-gray-50 p-3">
                                        <p class="text-xs font-bold text-gray-400">Teacher</p>
                                        <p class="mt-1 truncate text-sm font-black text-gray-800">{{ $batch->teachers->count() ? implode(', ', $batch->teachers->unique('id')->pluck('name')->toArray()) : 'Teacher TBA' }}</p>
                                    </div>
                                    <div class="rounded-2xl bg-gray-50 p-3">
                                        <p class="text-xs font-bold text-gray-400">Next Class</p>
                                        <p class="mt-1 truncate text-sm font-black text-gray-800">{{ $batch->nextClassForHumans() }}</p>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <div class="mb-2 flex items-center justify-between text-xs">
                                        <span class="font-black uppercase tracking-[0.16em] text-gray-400">Progress</span>
                                        <span class="font-black text-[#101828]">{{ $enrollment->progress_percentage }}%</span>
                                    </div>
                                    <div class="h-3 overflow-hidden rounded-full bg-gray-100">
                                        <div class="h-full rounded-full bg-emerald-500" style="width: {{ $enrollment->progress_percentage }}%"></div>
                                    </div>
                                </div>

                                <div class="mt-5 flex flex-col gap-3 sm:flex-row">
                                    <a href="{{ route('batches.show', $batch) }}" class="inline-flex flex-1 justify-center rounded-2xl bg-[#101828] px-4 py-3 text-sm font-black text-white hover:bg-gray-800">Open Batch</a>
                                    @if($batch->meeting_link && $enrollment->status === 'active')
                                        <a href="{{ $batch->meeting_link }}" target="_blank" class="inline-flex flex-1 justify-center rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-black text-white hover:bg-emerald-700">Join Live</a>
                                    @elseif($enrollment->status === 'active')
                                        <form method="POST" action="{{ route('student.enrollments.destroy', $batch) }}" onsubmit="return confirm('Drop this batch? Your progress will remain, but your enrollment will become inactive.')" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full rounded-2xl border border-red-200 px-4 py-3 text-sm font-black text-red-600 hover:bg-red-50">Drop</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>

        <aside class="space-y-5">
            <section class="rounded-[2rem] border border-gray-200 bg-white p-5 shadow-sm">
                <h2 class="text-lg font-black text-gray-950">Study Tools</h2>
                <div class="mt-4 grid gap-3">
                    <a href="{{ route('notes.index', ['class' => auth()->user()->class_level ?? '10']) }}" class="flex items-center gap-3 rounded-2xl bg-gray-50 p-3 hover:bg-gray-100">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-amber-100 text-amber-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h7l5 5v13H7zM14 3v6h5M9 14h8M9 18h5"/></svg>
                        </span>
                        <span>
                            <span class="block text-sm font-black text-gray-900">Class Notes</span>
                            <span class="block text-xs font-semibold text-gray-500">NCERT and PYQ material</span>
                        </span>
                    </a>
                    <a href="{{ route('batches.index') }}" class="flex items-center gap-3 rounded-2xl bg-gray-50 p-3 hover:bg-gray-100">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-100 text-sky-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0 1 21 8.618v6.764a1 1 0 0 1-1.447.894L15 14M4 6h8a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H4z"/></svg>
                        </span>
                        <span>
                            <span class="block text-sm font-black text-gray-900">Live Batches</span>
                            <span class="block text-xs font-semibold text-gray-500">Find your next program</span>
                        </span>
                    </a>
                </div>
            </section>

            <section class="rounded-[2rem] bg-[#fff7e6] p-5">
                <p class="text-xs font-black uppercase tracking-[0.16em] text-amber-700">Exam Mode</p>
                <h2 class="mt-2 text-xl font-black text-gray-950">Build consistency before speed.</h2>
                <p class="mt-2 text-sm font-semibold leading-6 text-gray-600">Complete one lecture and one notes chapter daily to keep momentum steady.</p>
            </section>
        </aside>
    </section>
</div>
@endsection
