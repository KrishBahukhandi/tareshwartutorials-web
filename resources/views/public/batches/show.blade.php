@extends('layouts.public')

@section('title', $batch->name . ' - Tareshwar Tutorials')

@section('content')
@php
    $activeCount = $batch->enrollmentCount();
    $capacityPercent = $batch->student_limit > 0 ? min(100, round(($activeCount / $batch->student_limit) * 100)) : 0;
    $isActiveEnrollment = $enrollment?->status === 'active';
@endphp

<section class="bg-primary py-xxl">
    <div class="max-w-container-max mx-auto px-gutter grid lg:grid-cols-[1fr_360px] gap-xl items-start">
        <div>
            <a href="{{ route('batches.index') }}" class="text-blue-100/80 text-sm font-semibold hover:text-white">Back to batches</a>
            <p class="text-blue-100/70 text-sm font-semibold mt-lg">{{ implode(', ', $batch->subjects->pluck('name')->toArray()) }} - {{ $batch->grade }}</p>
            <h1 class="text-4xl font-extrabold text-white mt-sm leading-tight">{{ $batch->name }}</h1>
            <p class="text-blue-100/80 mt-md max-w-2xl">Live classes, structured notes, recorded lectures, and teacher guidance in one focused batch.</p>
        </div>

        <div class="bg-white rounded-xl p-lg shadow-xl">
            <div class="flex items-center justify-between text-sm mb-sm">
                <span class="font-semibold text-gray-600">Capacity</span>
                <span class="font-bold text-primary">{{ $activeCount }}/{{ $batch->student_limit }} enrolled</span>
            </div>
            <div class="h-2 rounded-full bg-gray-100 overflow-hidden mb-lg">
                <div class="h-full bg-secondary" style="width: {{ $capacityPercent }}%"></div>
            </div>

            <div class="space-y-sm text-sm text-gray-600 mb-lg">
                <p><span class="font-semibold text-gray-900">Faculty:</span> 
                    @if($batch->teachers->unique('id')->count() > 1)
                        Multiple Instructors
                    @elseif($batch->teachers->unique('id')->count() == 1)
                        {{ $batch->teachers->first()->name }}
                    @else
                        Teacher TBA
                    @endif
                </p>
                <p><span class="font-semibold text-gray-900">Schedule:</span> {{ $batch->formattedSchedule() }}</p>
                <p><span class="font-semibold text-gray-900">Next class:</span> {{ $batch->nextClassForHumans() }}</p>
                <p><span class="font-semibold text-gray-900">Seats left:</span> {{ $batch->availableSeats() }}</p>
            </div>

            @auth
                @if(auth()->user()->isStudent())
                    @if($isActiveEnrollment)
                        <div class="rounded-lg bg-emerald-50 border border-emerald-200 px-md py-sm text-sm font-semibold text-emerald-700 mb-sm">Already Enrolled</div>
                        <form method="POST" action="{{ route('student.enrollments.destroy', $batch) }}" onsubmit="return confirm('Drop this batch? Your enrollment will become inactive.')" class="mt-sm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full border border-red-200 text-red-600 px-lg py-md rounded-lg font-bold hover:bg-red-50">Drop Batch</button>
                        </form>
                    @elseif(! $batch->is_active)
                        <div class="rounded-lg bg-gray-100 px-md py-sm text-sm font-semibold text-gray-600">Batch Inactive</div>
                    @elseif($batch->isFull())
                        <div class="rounded-lg bg-amber-50 border border-amber-200 px-md py-sm text-sm font-semibold text-amber-700">Batch Full</div>
                    @else
                        <a href="{{ route('student.checkout.show', $batch) }}" class="block text-center w-full bg-primary text-white px-lg py-md rounded-lg font-bold hover:bg-primary-container">
                            Enroll Now
                        </a>
                    @endif
                @else
                    <div class="rounded-lg bg-blue-50 px-md py-sm text-sm font-semibold text-blue-700">Only student accounts can enroll.</div>
                @endif
            @else
                <a href="{{ route('login') }}" class="block text-center bg-primary text-white px-lg py-md rounded-lg font-bold hover:bg-primary-container">Sign In to Enroll</a>
            @endauth
        </div>
    </div>
</section>

<section class="py-xxl bg-background">
    <div class="max-w-container-max mx-auto px-gutter grid lg:grid-cols-3 gap-xl">
        <div class="lg:col-span-2 bg-white rounded-xl border border-outline-variant p-xl">
            <h2 class="text-2xl font-bold text-primary mb-md">What you will get</h2>
            <div class="grid sm:grid-cols-2 gap-md">
                <div class="rounded-lg bg-surface-container-low p-md">
                    <h3 class="font-bold text-primary">Live Sessions</h3>
                    <p class="text-sm text-on-surface-variant mt-xs">Attend scheduled teacher-led classes with a stable meeting link.</p>
                </div>
                <div class="rounded-lg bg-surface-container-low p-md">
                    <h3 class="font-bold text-primary">Recorded Lectures</h3>
                    <p class="text-sm text-on-surface-variant mt-xs">Review uploaded video lessons as the batch progresses.</p>
                </div>
                <div class="rounded-lg bg-surface-container-low p-md">
                    <h3 class="font-bold text-primary">Batch Notes</h3>
                    <p class="text-sm text-on-surface-variant mt-xs">Access teacher-uploaded PDFs, documents, and slides.</p>
                </div>
                <div class="rounded-lg bg-surface-container-low p-md">
                    <h3 class="font-bold text-primary">Progress Tracking</h3>
                    <p class="text-sm text-on-surface-variant mt-xs">See your enrollment status and progress from the student dashboard.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-outline-variant p-xl">
            <h2 class="text-lg font-bold text-primary mb-md">Batch Status</h2>
            <div class="space-y-sm text-sm">
                <div class="flex justify-between"><span class="text-on-surface-variant">Status</span><span class="font-bold {{ $batch->is_active ? 'text-emerald-600' : 'text-gray-500' }}">{{ $batch->is_active ? 'Active' : 'Inactive' }}</span></div>
                <div class="flex justify-between"><span class="text-on-surface-variant">Available seats</span><span class="font-bold text-primary">{{ $batch->availableSeats() }}</span></div>
                <div class="flex justify-between"><span class="text-on-surface-variant">Subject(s)</span><span class="font-bold text-primary">{{ implode(', ', $batch->subjects->pluck('name')->toArray()) }}</span></div>
                <div class="flex justify-between"><span class="text-on-surface-variant">Grade</span><span class="font-bold text-primary">{{ $batch->grade }}</span></div>
            </div>
        </div>
    </div>
</section>
@endsection
