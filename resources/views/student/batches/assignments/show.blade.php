@extends('layouts.student')

@section('title', $assignment->title)

@section('content')
<div class="px-5 py-6 sm:px-10 lg:px-16">
    <div class="mb-8">
        <a href="{{ route('student.batches.assignments.index', $batch) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors mb-4">
            <span class="material-symbols-outlined text-[18px] mr-1">arrow_back</span>
            Back to Assignments
        </a>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $assignment->title }}</h1>
        <p class="mt-2 text-sm text-gray-600">{{ $batch->name }}</p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-green-400 mr-3">check_circle</span>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-red-400 mr-3">error</span>
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Assignment Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-100">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Due Date</p>
                        <p class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-[20px]">calendar_today</span>
                            {{ $assignment->due_date->format('l, F j, Y \a\t h:i A') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-500 mb-1">Points</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $assignment->total_marks }}</p>
                    </div>
                </div>
                
                @if($assignment->description)
                    <div class="prose prose-blue max-w-none mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Instructions</h3>
                        <div class="text-gray-700 whitespace-pre-wrap">{{ $assignment->description }}</div>
                    </div>
                @endif
                
                @if($assignment->file_path)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Reference Materials</h3>
                        <a href="{{ $assignment->fileUrl() }}" target="_blank" class="inline-flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors w-full sm:w-auto">
                            <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined">picture_as_pdf</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Question Paper.pdf</p>
                                <p class="text-xs text-gray-500">Click to view/download</p>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            
            @if($submission && $submission->teacher_feedback)
            <!-- Teacher Feedback -->
            <div class="bg-blue-50 border border-blue-100 rounded-2xl shadow-sm p-8">
                <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">forum</span>
                    Teacher Feedback
                </h3>
                <div class="bg-white rounded-xl p-5 border border-blue-100 text-gray-700 whitespace-pre-wrap shadow-sm">
                    {{ $submission->teacher_feedback }}
                </div>
            </div>
            @endif
        </div>

        <!-- Submission Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Your Work</h3>
                
                @if($submission)
                    <!-- Existing Submission -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-500">Status</span>
                            @if($submission->graded_at)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Graded
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Submitted
                                </span>
                            @endif
                        </div>
                        
                        @if($submission->graded_at)
                            <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-500">Grade</span>
                                <span class="text-xl font-bold text-gray-900">{{ $submission->marks_awarded }} <span class="text-sm font-normal text-gray-500">/ {{ $assignment->total_marks }}</span></span>
                            </div>
                        @endif

                        <a href="{{ $submission->fileUrl() }}" target="_blank" class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors mb-6">
                            <span class="material-symbols-outlined text-red-500">picture_as_pdf</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Your_Submission.pdf</p>
                                <p class="text-xs text-gray-500">Submitted {{ $submission->submitted_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    </div>
                @endif
                
                @if(!$assignment->due_date->isPast() && (!$submission || !$submission->graded_at))
                    <form action="{{ route('student.batches.assignments.submit', [$batch, $assignment]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $submission ? 'Update Submission' : 'Upload Submission' }} (PDF only)
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-colors cursor-pointer relative">
                                <div class="space-y-1 text-center">
                                    <span class="material-symbols-outlined text-4xl text-gray-400">upload_file</span>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="submission_file" class="relative cursor-pointer bg-transparent rounded-md font-medium text-[#1e3a8a] hover:text-blue-700 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="submission_file" name="submission_file" type="file" class="sr-only" required accept=".pdf">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF up to 10MB</p>
                                </div>
                            </div>
                            @error('submission_file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="mt-6 w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#1e3a8a] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1e3a8a] transition-colors">
                            {{ $submission ? 'Resubmit Assignment' : 'Submit Assignment' }}
                        </button>
                    </form>
                @elseif($assignment->due_date->isPast() && !$submission)
                    <div class="p-4 bg-red-50 rounded-lg text-center">
                        <span class="material-symbols-outlined text-red-500 mb-2 text-3xl">block</span>
                        <p class="text-sm font-medium text-red-800">The due date for this assignment has passed.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Simple script to show the selected filename
    document.getElementById('submission_file')?.addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            const fileName = e.target.files[0].name;
            const label = e.target.parentElement.querySelector('span');
            label.textContent = fileName;
        }
    });
</script>
@endsection
