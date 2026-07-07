@extends('layouts.admin')

@section('title', 'Teachers')
@section('search_placeholder', 'Search teachers...')

@section('content')
<div class="p-6">

    {{-- Page Header --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <nav class="text-xs text-gray-400 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-600">Faculty Management</a>
                <span class="mx-1">›</span>
                <span class="text-gray-600">All Teachers</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Teachers</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage all faculty accounts and their access.</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}"
           class="flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] text-white rounded-lg text-sm font-semibold hover:bg-[#162d4a] transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Teacher
        </a>
    </div>

    {{-- Teachers Table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if($teachers->isEmpty())
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">No teachers onboarded yet.</p>
                <p class="text-sm text-gray-400 mt-1">Click "Add Teacher" to register your first faculty member.</p>
            </div>
        @else
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Teacher</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Department / Subject</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Qualification</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Status</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($teachers as $teacher)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $teacher->profilePhotoUrl() }}"
                                         alt="{{ $teacher->name }}"
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $teacher->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $teacher->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-800">{{ $teacher->department ?? '—' }}</p>
                                <p class="text-xs text-gray-400">{{ $teacher->subject ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-800">{{ $teacher->highest_degree ?? '—' }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $teacher->institution ?? '' }}
                                    @if($teacher->years_of_experience)
                                        · {{ $teacher->years_of_experience }} yrs exp
                                    @endif
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                             {{ $teacher->is_active
                                                 ? 'bg-emerald-50 text-emerald-700'
                                                 : 'bg-red-50 text-red-700' }}">
                                    <span class="w-1.5 h-1.5 rounded-full inline-block
                                                 {{ $teacher->is_active ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                    {{ $teacher->is_active ? 'Active' : 'Disabled' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST"
                                      action="{{ route('admin.teachers.toggle', $teacher) }}"
                                      onsubmit="return confirm('{{ $teacher->is_active ? 'Disable' : 'Enable' }} this teacher account?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="text-xs font-semibold px-3 py-1.5 rounded-lg border transition-colors
                                                   {{ $teacher->is_active
                                                       ? 'border-red-200 text-red-600 hover:bg-red-50'
                                                       : 'border-emerald-200 text-emerald-600 hover:bg-emerald-50' }}">
                                        {{ $teacher->is_active ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection
