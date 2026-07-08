@extends('layouts.teacher')

@section('title', 'Create Assignment - ' . $batch->name)

@section('content')
<div class="px-5 py-6 sm:px-10 lg:px-16 max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('teacher.batches.assignments.index', $batch) }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors mb-4">
            <span class="material-symbols-outlined text-[18px] mr-1">arrow_back</span>
            Back to Assignments
        </a>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Create Assignment</h1>
        <p class="mt-2 text-sm text-gray-600">Add a new assignment or quiz for {{ $batch->name }}</p>
    </div>

    <form action="{{ route('teacher.batches.assignments.store', $batch) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-900">Assignment Title</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="e.g., Chapter 4 Algebra Homework" class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#1e3a8a] sm:text-sm sm:leading-6">
                </div>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-900">Description / Instructions</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="4" placeholder="Optional instructions..." class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#1e3a8a] sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="due_date" class="block text-sm font-semibold text-gray-900">Due Date</label>
                    <div class="mt-2">
                        <input type="datetime-local" name="due_date" id="due_date" required value="{{ old('due_date') }}" class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#1e3a8a] sm:text-sm sm:leading-6">
                    </div>
                    @error('due_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="total_marks" class="block text-sm font-semibold text-gray-900">Total Marks</label>
                    <div class="mt-2">
                        <input type="number" name="total_marks" id="total_marks" required min="1" value="{{ old('total_marks', 100) }}" class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#1e3a8a] sm:text-sm sm:leading-6">
                    </div>
                    @error('total_marks')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="file" class="block text-sm font-semibold text-gray-900">Question File (Optional, PDF only)</label>
                <div class="mt-2">
                    <input type="file" name="file" id="file" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                </div>
                <p class="mt-2 text-xs text-gray-500">Max size: 10MB. Upload a worksheet or question paper for students to download.</p>
                @error('file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('teacher.batches.assignments.index', $batch) }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-5 py-2.5 bg-[#1e3a8a] text-white text-sm font-medium rounded-lg hover:bg-blue-900 transition-colors shadow-sm">
                Create Assignment
            </button>
        </div>
    </form>
</div>
@endsection
