@extends('layouts.student')

@section('title', 'Assignments - ' . $batch->name)

@section('content')
<div class="px-5 py-6 sm:px-10 lg:px-16">
    <div class="mb-8">
        <a href="{{ route('student.batches.show', $batch) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors mb-4">
            <span class="material-symbols-outlined text-[18px] mr-1">arrow_back</span>
            Back to Batch
        </a>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Assignments</h1>
        <p class="mt-2 text-sm text-gray-600">Your assignments for {{ $batch->name }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        @if($assignments->isEmpty())
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-4">
                    <span class="material-symbols-outlined text-3xl">assignment_turned_in</span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No assignments yet</h3>
                <p class="text-gray-500">Your teacher hasn't posted any assignments for this batch.</p>
            </div>
        @else
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($assignments as $assignment)
                    @php
                        $submission = $assignment->submissions->first();
                        $isPastDue = $assignment->due_date->isPast();
                    @endphp
                    <li class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $assignment->title }}</h3>
                                    
                                    @if($submission && $submission->graded_at)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Graded: {{ $submission->marks_awarded }}/{{ $assignment->total_marks }}
                                        </span>
                                    @elseif($submission)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Submitted
                                        </span>
                                    @elseif($isPastDue)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Missing
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-1 flex items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1.5 {{ $isPastDue && !$submission ? 'text-red-600 font-medium' : '' }}">
                                        <span class="material-symbols-outlined text-[18px]">schedule</span>
                                        Due: {{ $assignment->due_date->format('M d, Y h:i A') }}
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[18px]">grade</span>
                                        {{ $assignment->total_marks }} Marks
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a href="{{ route('student.batches.assignments.show', [$batch, $assignment]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#1e3a8a] rounded-lg hover:bg-blue-900 transition-colors shadow-sm">
                                    {{ $submission ? 'View Submission' : 'Submit Assignment' }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
