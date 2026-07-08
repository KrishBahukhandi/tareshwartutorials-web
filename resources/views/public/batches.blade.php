@extends('layouts.public')

@section('title', 'Browse Batches - Tareshwar Tutorials')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex flex-col md:flex-row gap-8">
            
            {{-- Sidebar Filters --}}
            <aside class="w-full md:w-64 shrink-0">
                <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Filters</h2>
                    
                                    <form action="{{ route('batches.index') }}" method="GET">
                        {{-- Keywords --}}
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Keywords</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search batches..."
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#0A1A2F] focus:border-[#0A1A2F]">
                            </div>
                        </div>

                        {{-- Class Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wider text-[11px]">Class</label>
                            <div class="space-y-2.5">
                                @foreach(['Class 9', 'Class 10', 'Class 11', 'Class 12'] as $cls)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="grade" value="{{ $cls }}"
                                               class="border-gray-300 text-[#0A1A2F] focus:ring-[#0A1A2F]"
                                               {{ request('grade') === $cls ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ $cls }}</span>
                                    </label>
                                @endforeach
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="grade" value=""
                                           class="border-gray-300 text-[#0A1A2F] focus:ring-[#0A1A2F]"
                                           {{ !request('grade') ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">All Classes</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-2 bg-[#0A1A2F] text-white text-sm font-semibold rounded hover:bg-[#162d4a] transition-colors mb-2">
                            Apply Filters
                        </button>
                        <button type="reset" onclick="window.location='{{ route('batches.index') }}'" class="w-full py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded hover:bg-gray-200 transition-colors">
                            Reset
                        </button>
                    </form>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1">
                
                {{-- Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-[#0A1A2F]">Available Batches</h1>
                        <p class="text-sm text-gray-500 mt-1">Showing {{ $batches->count() }} upcoming batches for your selection</p>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-gray-500">Sort by:</span>
                        <select class="border-none bg-transparent text-[#0A1A2F] font-semibold focus:ring-0 cursor-pointer">
                            <option>Latest Start</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                        </select>
                    </div>
                </div>

                {{-- Batches Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @forelse($batches as $index => $batch)
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col hover:shadow-lg transition-shadow relative">
                            
                            {{-- Badges Mockup Logic --}}
                            @if($index === 0 || $index === 5)
                                <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded z-10">Trending</span>
                            @elseif($index === 1)
                                <span class="absolute top-3 right-3 bg-emerald-500 text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded z-10">New</span>
                            @endif

                            <div class="h-40 bg-gray-200 relative">
                                @php
                                    $images = [
                                        'https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                        'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                        'https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                        'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                                        'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'
                                    ];
                                    $imgSrc = $images[$index % count($images)];
                                @endphp
                                <img src="{{ $imgSrc }}" alt="{{ $batch->name }}" class="w-full h-full object-cover">
                            </div>
                            
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="text-base font-bold text-gray-900 mb-1 leading-tight">{{ $batch->name }}</h3>
                                @if($batch->teachers->unique('id')->count() > 1)
                                    <p class="text-xs text-gray-500 mb-4">Multiple Instructors</p>
                                @elseif($batch->teachers->unique('id')->count() == 1)
                                    <p class="text-xs text-gray-500 mb-4">{{ $batch->teachers->first()->name }}</p>
                                @else
                                    <p class="text-xs text-gray-500 mb-4">TBA</p>
                                @endif
                                
                                <div class="flex items-center gap-4 text-xs text-gray-500 mb-5 flex-1">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        12 Weeks
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        {{ $batch->student_limit }} Students
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    @if($batch->price > 0)
                                        <span class="text-lg font-extrabold text-gray-900">₹{{ number_format($batch->price, 2) }}</span>
                                    @else
                                        <span class="text-lg font-extrabold text-emerald-600">Free</span>
                                    @endif
                                    <a href="{{ route('batches.show', $batch) }}" class="px-4 py-1.5 border border-gray-300 text-gray-700 text-sm font-semibold rounded hover:bg-gray-50 transition-colors">View Details</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-xl border border-gray-200">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No batches found</h3>
                            <p class="text-gray-500">Try adjusting your filters or search terms.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination Placeholder (styling matches mockup) --}}
                @if($batches->hasPages())
                    <div class="flex justify-center pb-8">
                        {{ $batches->links('vendor.pagination.tailwind') }}
                    </div>
                @else
                    <div class="flex justify-center pb-8">
                        <nav class="flex items-center gap-2">
                            <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:bg-gray-50 disabled:opacity-50">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded bg-[#0A1A2F] text-white font-medium text-sm">
                                1
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:bg-gray-50 disabled:opacity-50">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </nav>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection
