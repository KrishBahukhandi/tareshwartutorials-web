@extends('layouts.public')

@section('title', 'Free NCERT Notes Class ' . $classLevel . ($subject ? ' — ' . $subject : '') . ' | Tareshwar Tutorials')

@section('content')

{{-- ── Hero ── --}}
<section class="bg-primary py-xl">
    <div class="max-w-container-max mx-auto px-gutter">
        <p class="text-sm text-blue-200/70 mb-1">Free Study Material</p>
        <h1 class="text-3xl font-extrabold text-white mb-2">
            NCERT Notes — Class {{ $classLevel }}{{ $subject ? ': ' . $subject : '' }}
        </h1>
        <p class="text-blue-100/70 text-sm">Free, no sign-up required. Browse, read, and download.</p>
    </div>
</section>

{{-- ── Class Tabs ── --}}
<div class="bg-white border-b border-outline-variant sticky top-[57px] z-40 shadow-sm">
    <div class="max-w-container-max mx-auto px-gutter flex gap-0 overflow-x-auto">
        @foreach(['10' => 'Class 10', '11' => 'Class 11', '12' => 'Class 12'] as $cls => $label)
            <a href="{{ route('notes.index', ['class' => $cls]) }}"
               class="shrink-0 px-xl py-md text-sm font-semibold border-b-2 transition-colors
                      {{ $classLevel === $cls
                          ? 'border-primary text-primary'
                          : 'border-transparent text-on-surface-variant hover:text-primary' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

{{-- ── Subject Filter Pills ── --}}
<div class="bg-surface-container-low border-b border-outline-variant">
    <div class="max-w-container-max mx-auto px-gutter py-sm flex flex-wrap gap-sm">
        <a href="{{ route('notes.index', ['class' => $classLevel]) }}"
           class="px-md py-1.5 rounded-full text-xs font-semibold border transition-colors
                  {{ ! $subject ? 'bg-primary text-white border-primary' : 'border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary' }}">
            All Subjects
        </a>
        @foreach($subjects as $sub)
            <a href="{{ route('notes.index', ['class' => $classLevel, 'subject' => $sub]) }}"
               class="px-md py-1.5 rounded-full text-xs font-semibold border transition-colors
                      {{ $subject === $sub ? 'bg-primary text-white border-primary' : 'border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary' }}">
                {{ $sub }}
            </a>
        @endforeach
    </div>
</div>

{{-- ── Resources Grid ── --}}
<section class="py-xxl bg-background">
    <div class="max-w-container-max mx-auto px-gutter">

        @if($resources->isEmpty())
            {{-- Empty state --}}
            <div class="text-center py-xxl">
                <div class="w-20 h-20 bg-secondary-fixed rounded-full flex items-center justify-center mx-auto mb-lg">
                    <svg class="w-10 h-10 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-sm">Notes coming soon!</h3>
                <p class="text-on-surface-variant text-sm max-w-sm mx-auto">
                    We're working on adding notes for {{ $subject ?? 'Class ' . $classLevel }}.
                    Check back soon or explore other subjects.
                </p>
            </div>
        @else
            {{-- Group by subject if viewing all --}}
            @php
                $grouped = $resources->groupBy('subject');
            @endphp

            @foreach($grouped as $subjectName => $items)
                <div class="mb-xxl">
                    <div class="flex items-center gap-md mb-lg">
                        <h2 class="text-xl font-bold text-primary">{{ $subjectName }}</h2>
                        <span class="text-xs text-on-surface-variant bg-surface-container px-sm py-0.5 rounded-full">
                            {{ $items->count() }} {{ Str::plural('note', $items->count()) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-lg">
                        @foreach($items as $resource)
                            <a href="{{ route('notes.show', $resource) }}"
                               class="bg-white rounded-xl border border-outline-variant shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group overflow-hidden flex flex-col">
                                {{-- Card top colour stripe based on subject --}}
                                <div class="h-1.5 bg-gradient-to-r
                                    @if(in_array($subjectName, ['Physics','Chemistry','Mathematics','Biology'])) from-blue-500 to-indigo-600
                                    @elseif(in_array($subjectName, ['History','Geography','Political Science'])) from-amber-500 to-orange-500
                                    @elseif(in_array($subjectName, ['Economics','Business Studies','Accountancy'])) from-green-500 to-emerald-600
                                    @else from-purple-500 to-pink-500
                                    @endif"></div>
                                <div class="p-lg flex-1 flex flex-col">
                                    {{-- Type badge --}}
                                    <div class="flex items-center justify-between mb-sm">
                                        <span class="text-xs font-bold px-sm py-0.5 rounded-full
                                            {{ $resource->type === 'note' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700' }}">
                                            {{ strtoupper($resource->type) }}
                                        </span>

                                    </div>
                                    <h3 class="font-semibold text-primary text-sm leading-snug mb-auto group-hover:text-secondary transition-colors">
                                        {{ $resource->title }}
                                    </h3>
                                    @if($resource->chapter)
                                        <p class="text-xs text-on-surface-variant mt-sm">{{ $resource->chapter }}</p>
                                    @endif
                                    <div class="mt-md pt-sm border-t border-outline-variant flex items-center justify-between">
                                        <span class="text-xs text-on-surface-variant">Class {{ $resource->class_level }} • {{ $resource->board ?? 'NCERT' }}</span>
                                        <span class="text-xs text-primary font-semibold group-hover:underline">Read →</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif

        {{-- CTA Banner --}}
        <div class="mt-xxl bg-primary rounded-2xl p-xl flex flex-col md:flex-row items-center justify-between gap-lg">
            <div>
                <h3 class="text-xl font-bold text-white mb-sm">Want structured, expert-led learning?</h3>
                <p class="text-blue-100/70 text-sm">Join our live batches for Class {{ $classLevel }} and get access to live classes, recorded sessions, and personal guidance.</p>
            </div>
            <a href="{{ route('batches.index') }}"
               class="shrink-0 bg-white text-primary font-bold px-xl py-md rounded-xl hover:bg-blue-50 transition-colors shadow-md">
                Explore Batches →
            </a>
        </div>
    </div>
</section>

@endsection
