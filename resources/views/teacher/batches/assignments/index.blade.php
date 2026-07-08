@extends('layouts.teacher')

@section('title', 'Assignments - ' . $batch->name)

@section('content')
<div class="px-5 py-6 sm:px-10 lg:px-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Assignments</h1>
            <p class="mt-2 text-sm text-gray-600">Manage assignments for {{ $batch->name }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('teacher.batches.show', $batch) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                Back to Batch
            </a>
            <a href="{{ route('teacher.batches.assignments.create', $batch) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#1e3a8a] text-white text-sm font-medium rounded-lg hover:bg-blue-900 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">add</span>
                New Assignment
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-green-400 mr-3">check_circle</span>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        @if($assignments->isEmpty())
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-4">
                    <span class="material-symbols-outlined text-3xl">assignment</span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">No assignments yet</h3>
                <p class="text-gray-500 mb-4">Get started by creating the first assignment for this batch.</p>
                <a href="{{ route('teacher.batches.assignments.create', $batch) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#1e3a8a] bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    Create Assignment
                </a>
            </div>
        @else
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($assignments as $assignment)
                    <li class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $assignment->title }}</h3>
                                    @if($assignment->due_date->isPast())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Past Due
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-1 flex items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                        Due: {{ $assignment->due_date->format('M d, Y h:i A') }}
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[18px]">group</span>
                                        {{ $assignment->submissions_count }} Submissions
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[18px]">grade</span>
                                        {{ $assignment->total_marks }} Marks
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 ml-4">
                                <a href="{{ route('teacher.batches.assignments.submissions.index', [$batch, $assignment]) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-700 bg-blue-50 border border-transparent rounded-lg hover:bg-blue-100 transition-colors">
                                    Grade Submissions
                                </a>
                                <form action="{{ route('teacher.batches.assignments.destroy', [$batch, $assignment]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment? All submissions will be permanently deleted.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-gray-100" title="Delete">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
