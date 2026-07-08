@extends('layouts.admin')

@section('title', 'Manage Batch - EduAdmin')
@section('header', 'Manage Batch: ' . $batch->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.batches.index') }}" class="text-sm font-semibold text-gray-500 hover:text-[#1e3a5f] flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Batches
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-50 rounded-lg border border-green-100 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900">{{ $batch->name }}</h2>
            <p class="text-sm text-gray-500 mt-1">
                Class: {{ $batch->grade }} • Schedule: {{ $batch->formattedSchedule() }} •
                Price: {{ $batch->price > 0 ? '₹'.number_format($batch->price, 2) : 'Free' }}
            </p>
        </div>

        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-4">Subjects & Faculty</h3>
        
        <div class="border border-gray-100 rounded-lg overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th class="px-5 py-3 font-semibold text-gray-500">Subject</th>
                        <th class="px-5 py-3 font-semibold text-gray-500">Instructor</th>
                        <th class="px-5 py-3 font-semibold text-gray-500 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($batch->subjects as $subject)
                        <tr>
                            <td class="px-5 py-4 font-medium text-gray-900">{{ $subject->name }}</td>
                            <td class="px-5 py-4">
                                @if($subject->teacher)
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $subject->teacher->profilePhotoUrl() }}" alt="" class="w-6 h-6 rounded-full object-cover">
                                        <span class="text-gray-700 font-medium">{{ $subject->teacher->name }}</span>
                                    </div>
                                @else
                                    <span class="inline-block px-2.5 py-1 text-xs font-semibold text-orange-700 bg-orange-50 rounded-full">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <form action="{{ route('admin.batches.assignTeacher', [$batch, $subject]) }}" method="POST" class="flex items-center justify-end gap-2">
                                    @csrf
                                    <select name="teacher_id" class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white min-w-[160px]">
                                        <option value="">Unassigned</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $subject->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="px-4 py-1.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                                        Save
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center text-gray-400 text-sm">No subjects defined for this batch.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
