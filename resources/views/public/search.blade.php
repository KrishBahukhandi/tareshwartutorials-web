@extends('layouts.public')

@section('title', ($query ? 'Search results for "'.$query.'"' : 'Search') . ' | Tareshwar Tutorials')
@section('description', 'Search live batches, free NCERT notes, and previous year question papers on Tareshwar Tutorials.')
@section('robots', 'noindex, follow')

@section('content')

{{-- ── Hero ── --}}
<section class="bg-primary py-xl">
    <div class="max-w-container-max mx-auto px-gutter">
        <p class="text-sm text-blue-200/70 mb-1">Search</p>
        <h1 class="text-3xl font-extrabold text-white mb-2">
            @if($query)
                Results for "{{ $query }}"
            @else
                Search Tareshwar Tutorials
            @endif
        </h1>
        <form action="{{ route('search') }}" method="GET" class="max-w-xl mt-md">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input type="text" name="search" value="{{ $query }}" placeholder="Search batches, notes, PYQs..."
                       class="w-full pl-11 pr-4 py-3 rounded-xl border-0 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-white/40">
            </div>
        </form>
    </div>
</section>

<section class="py-xxl bg-background">
    <div class="max-w-container-max mx-auto px-gutter">

        @if(! $query)
            <div class="text-center py-xxl">
                <p class="text-on-surface-variant text-sm">Type at least 2 characters to search across batches, notes, and PYQs.</p>
            </div>
        @elseif(! $hasResults)
            <div class="text-center py-xxl bg-white rounded-2xl border border-outline-variant shadow-sm max-w-2xl mx-auto">
                <div class="w-20 h-20 bg-secondary-fixed rounded-full flex items-center justify-center mx-auto mb-lg">
                    <span class="material-symbols-outlined text-[40px] text-secondary">search_off</span>
                </div>
                <h3 class="text-xl font-bold text-primary mb-sm">No results for "{{ $query }}"</h3>
                <p class="text-on-surface-variant text-sm max-w-sm mx-auto mb-lg">
                    Try a different keyword, or browse batches and notes directly.
                </p>
                <div class="flex items-center justify-center gap-md">
                    <a href="{{ route('batches.index') }}" class="bg-primary text-white px-lg py-sm rounded-lg font-semibold text-sm hover:bg-secondary transition-colors">Browse Batches</a>
                    <a href="{{ route('notes.index') }}" class="border border-outline-variant text-primary px-lg py-sm rounded-lg font-semibold text-sm hover:bg-surface-container-low transition-colors">Browse Notes</a>
                </div>
            </div>
        @else
            <div class="space-y-xxl">

                {{-- Batches --}}
                @if($batches->isNotEmpty())
                    <div>
                        <div class="flex items-center justify-between mb-lg">
                            <h2 class="text-xl font-bold text-primary">Batches <span class="text-sm font-normal text-on-surface-variant">({{ $totalBatches }})</span></h2>
                            @if($totalBatches > $batches->count())
                                <a href="{{ route('batches.index', ['search' => $query]) }}" class="text-sm font-semibold text-primary hover:underline">View all →</a>
                            @endif
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg">
                            @foreach($batches as $batch)
                                <a href="{{ route('batches.show', $batch) }}" class="bg-white rounded-xl border border-outline-variant shadow-sm hover:shadow-lg transition-all p-lg block">
                                    <h3 class="font-semibold text-primary text-sm mb-1">{{ $batch->name }}</h3>
                                    <p class="text-xs text-on-surface-variant">{{ $batch->subjectNames() }} • {{ $batch->grade }}</p>
                                    <p class="text-xs font-bold mt-sm {{ $batch->price > 0 ? 'text-primary' : 'text-emerald-600' }}">
                                        {{ $batch->price > 0 ? '₹'.number_format($batch->price, 0) : 'Free' }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Notes --}}
                @if($notes->isNotEmpty())
                    <div>
                        <h2 class="text-xl font-bold text-primary mb-lg">Notes <span class="text-sm font-normal text-on-surface-variant">({{ $notes->count() }})</span></h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-lg">
                            @foreach($notes as $note)
                                <a href="{{ route('notes.show', $note) }}" class="bg-white rounded-xl border border-outline-variant shadow-sm hover:shadow-lg transition-all p-lg block">
                                    <span class="text-xs font-bold px-sm py-0.5 rounded-full bg-blue-50 text-blue-700">NOTE</span>
                                    <h3 class="font-semibold text-primary text-sm mt-sm">{{ $note->title }}</h3>
                                    <p class="text-xs text-on-surface-variant mt-1">Class {{ $note->class_level }} • {{ $note->subject }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- PYQs --}}
                @if($pyqs->isNotEmpty())
                    <div>
                        <h2 class="text-xl font-bold text-primary mb-lg">Previous Year Questions <span class="text-sm font-normal text-on-surface-variant">({{ $pyqs->count() }})</span></h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-lg">
                            @foreach($pyqs as $pyq)
                                <a href="{{ route('notes.show', $pyq) }}" class="bg-white rounded-xl border border-outline-variant shadow-sm hover:shadow-lg transition-all p-lg block">
                                    <span class="text-xs font-bold px-sm py-0.5 rounded-full bg-amber-50 text-amber-700">PYQ</span>
                                    <h3 class="font-semibold text-primary text-sm mt-sm">{{ $pyq->title }}</h3>
                                    <p class="text-xs text-on-surface-variant mt-1">Class {{ $pyq->class_level }} • {{ $pyq->subject }} • {{ $pyq->year }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Assignments --}}
                @if($assignments->isNotEmpty())
                    <div>
                        <h2 class="text-xl font-bold text-primary mb-lg">Assignments <span class="text-sm font-normal text-on-surface-variant">({{ $assignments->count() }})</span></h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-lg">
                            @foreach($assignments as $assignment)
                                <a href="{{ route('notes.show', $assignment) }}" class="bg-white rounded-xl border border-outline-variant shadow-sm hover:shadow-lg transition-all p-lg block">
                                    <span class="text-xs font-bold px-sm py-0.5 rounded-full bg-emerald-50 text-emerald-700">ASSIGNMENT</span>
                                    <h3 class="font-semibold text-primary text-sm mt-sm">{{ $assignment->title }}</h3>
                                    <p class="text-xs text-on-surface-variant mt-1">Class {{ $assignment->class_level }} • {{ $assignment->subject }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        @endif
    </div>
</section>

@endsection
