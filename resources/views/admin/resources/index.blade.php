@extends('layouts.admin')

@section('title', 'Free Resources')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-[#1e3a5f]">Free Resources</h1>
        <p class="text-sm text-gray-500 mt-0.5">NCERT Notes & PYQs uploaded for public access</p>
    </div>
    <a href="{{ route('admin.resources.create') }}"
       class="flex items-center gap-2 bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#162d4a] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Upload Resource
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Type</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Class</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Views</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Downloads</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($resources as $resource)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3.5">
                        <p class="font-semibold text-[#1e3a5f]">{{ $resource->title }}</p>
                        @if($resource->chapter)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $resource->chapter }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold
                            {{ $resource->type === 'note' ? 'bg-blue-50 text-blue-700' : ($resource->type === 'pyq' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700') }}">
                            {{ strtoupper($resource->type) }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-gray-600">Class {{ $resource->class_level }}</td>
                    <td class="px-5 py-3.5 text-gray-600">{{ $resource->subject }}</td>
                    <td class="px-5 py-3.5 text-gray-600">{{ number_format($resource->view_count) }}</td>
                    <td class="px-5 py-3.5 text-gray-600">{{ number_format($resource->download_count) }}</td>
                    <td class="px-5 py-3.5">
                        <form method="POST" action="{{ route('admin.resources.toggle', $resource) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="px-2 py-0.5 rounded-full text-xs font-bold
                                           {{ $resource->is_published ? 'bg-green-50 text-green-700 hover:bg-green-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}
                                           transition-colors cursor-pointer">
                                {{ $resource->is_published ? '● Published' : '○ Hidden' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('notes.show', $resource) }}" target="_blank"
                               class="text-xs text-gray-500 hover:text-[#1e3a5f] transition-colors font-medium">Preview</a>
                            <form method="POST" action="{{ route('admin.resources.destroy', $resource) }}"
                                  onsubmit="return confirm('Delete this resource?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-5 py-12 text-center text-gray-400 text-sm">
                        No resources uploaded yet.
                        <a href="{{ route('admin.resources.create') }}" class="text-[#1e3a5f] font-semibold hover:underline">Upload your first one →</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($resources->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $resources->links() }}
        </div>
    @endif
</div>
@endsection
