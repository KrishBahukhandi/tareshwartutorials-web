@extends('layouts.teacher')

@section('title', 'Grade - ' . $submission->student->name)

@section('content')
<div class="px-5 py-6 sm:px-10 lg:px-16">
    <div class="mb-8">
        <a href="{{ route('teacher.batches.assignments.submissions.index', [$batch, $assignment]) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors mb-4">
            <span class="material-symbols-outlined text-[18px] mr-1">arrow_back</span>
            Back to Submissions
        </a>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Grade Submission</h1>
        <p class="mt-2 text-sm text-gray-600">{{ $submission->student->name }} - {{ $assignment->title }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Student's Document -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden flex flex-col h-[600px]">
            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <span class="text-sm font-semibold text-gray-900">Student's Work</span>
                <a href="{{ asset('storage/' . $submission->file_path) }}" download class="inline-flex items-center gap-1.5 text-sm font-medium text-[#1e3a8a] hover:text-blue-700">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Download PDF
                </a>
            </div>
            <div class="flex-1 bg-gray-100">
                <iframe src="{{ asset('storage/' . $submission->file_path) }}#toolbar=0" class="w-full h-full border-0"></iframe>
            </div>
        </div>

        <!-- Grading Panel -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Evaluation</h3>
            
            <form action="{{ route('teacher.batches.assignments.submissions.grade', [$batch, $assignment, $submission]) }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label for="marks_awarded" class="block text-sm font-semibold text-gray-900">Marks Awarded (out of {{ $assignment->total_marks }})</label>
                        <div class="mt-2 flex items-center gap-2">
                            <input type="number" name="marks_awarded" id="marks_awarded" required min="0" max="{{ $assignment->total_marks }}" value="{{ old('marks_awarded', $submission->marks_awarded) }}" class="block w-32 rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#1e3a8a] sm:text-sm sm:leading-6 font-bold text-lg text-center">
                            <span class="text-gray-500 font-medium">/ {{ $assignment->total_marks }}</span>
                        </div>
                        @error('marks_awarded')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="teacher_feedback" class="block text-sm font-semibold text-gray-900">Feedback / Comments</label>
                        <div class="mt-2">
                            <textarea name="teacher_feedback" id="teacher_feedback" rows="6" placeholder="Great job on the equations, but remember to show your work..." class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#1e3a8a] sm:text-sm sm:leading-6">{{ old('teacher_feedback', $submission->teacher_feedback) }}</textarea>
                        </div>
                        @error('teacher_feedback')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="px-5 py-2.5 bg-[#1e3a8a] text-white text-sm font-medium rounded-lg hover:bg-blue-900 transition-colors shadow-sm w-full sm:w-auto">
                        Save Grades
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
