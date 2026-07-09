@extends('layouts.teacher')

@section('title', 'Grade Submissions - ' . $assignment->title)

@section('content')
<div class="px-5 py-6 sm:px-10 lg:px-16">
    <div class="mb-8">
        <a href="{{ route('teacher.batches.assignments.index', $batch) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors mb-4">
            <span class="material-symbols-outlined text-[18px] mr-1">arrow_back</span>
            Back to Assignments
        </a>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Grade Submissions</h1>
        <p class="mt-2 text-sm text-gray-600">Review and grade submissions for <strong>{{ $assignment->title }}</strong></p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-green-400 mr-3">check_circle</span>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Submissions List -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Submitted ({{ $submissions->count() }})</h3>
                </div>
                
                @if($submissions->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        No students have submitted this assignment yet.
                    </div>
                @else
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($submissions as $submission)
                            <li class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $submission->student->profilePhotoUrl() }}" alt="" class="w-10 h-10 rounded-full border border-gray-200">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $submission->student->name }}</p>
                                            <p class="text-xs text-gray-500">Submitted: {{ $submission->submitted_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        @if($submission->graded_at)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Graded: {{ $submission->marks_awarded }}/{{ $assignment->total_marks }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Needs Grading
                                            </span>
                                        @endif
                                        <a href="{{ route('teacher.batches.assignments.submissions.show', [$batch, $assignment, $submission]) }}" class="text-sm font-medium text-[#1e3a8a] hover:text-blue-700">
                                            Review
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Pending ({{ $pendingStudents->count() }})</h3>
                </div>
                <ul role="list" class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
                    @forelse($pendingStudents as $student)
                        <li class="px-6 py-3 flex items-center gap-3">
                            <img src="{{ $student->profilePhotoUrl() }}" alt="" class="w-8 h-8 rounded-full border border-gray-200">
                            <span class="text-sm text-gray-700">{{ $student->name }}</span>
                        </li>
                    @empty
                        <li class="px-6 py-4 text-sm text-gray-500">All enrolled students have submitted!</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Assignment Details Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Assignment Details</h3>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $assignment->due_date->format('M d, Y h:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Total Marks</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $assignment->total_marks }}</dd>
                    </div>
                    @if($assignment->description)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Instructions</dt>
                            <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $assignment->description }}</dd>
                        </div>
                    @endif
                    @if($assignment->file_path)
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ $assignment->fileUrl() }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-medium text-[#1e3a8a] hover:text-blue-700">
                                <span class="material-symbols-outlined text-[20px]">description</span>
                                View Question Paper
                            </a>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
