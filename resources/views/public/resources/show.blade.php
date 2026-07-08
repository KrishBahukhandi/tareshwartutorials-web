@extends('layouts.public')

@section('title', $freeResource->title . ' | Tareshwar Tutorials')
@section('description', Str::limit($freeResource->description ?? ($freeResource->title . ' — free ' . $freeResource->subject . ' study material for Class ' . $freeResource->class_level . '. View online or download the PDF.'), 160))
@section('og_type', 'article')

@push('json-ld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LearningResource',
    'name' => $freeResource->title,
    'description' => $freeResource->description ?? $freeResource->title,
    'learningResourceType' => ucfirst($freeResource->type),
    'educationalLevel' => 'Class '.$freeResource->class_level,
    'about' => $freeResource->subject,
    'provider' => [
        '@type' => 'EducationalOrganization',
        'name' => 'Tareshwar Tutorials',
        'sameAs' => url('/'),
    ],
], JSON_UNESCAPED_SLASHES) !!}
</script>
@endpush

@section('content')

<div class="max-w-container-max mx-auto px-gutter py-xl">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-sm text-xs text-on-surface-variant mb-lg">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
        <span>/</span>
        <a href="{{ route('notes.index', ['class' => $freeResource->class_level]) }}" class="hover:text-primary transition-colors">Class {{ $freeResource->class_level }} Notes</a>
        <span>/</span>
        <a href="{{ route('notes.index', ['class' => $freeResource->class_level, 'subject' => $freeResource->subject]) }}" class="hover:text-primary transition-colors">{{ $freeResource->subject }}</a>
        <span>/</span>
        <span class="text-primary font-medium truncate max-w-[180px]">{{ $freeResource->title }}</span>
    </nav>

    <div class="grid lg:grid-cols-3 gap-xl">

        {{-- ── Main Viewer ── --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
                {{-- Header --}}
                <div class="p-lg border-b border-outline-variant flex items-start justify-between gap-md">
                    <div>
                        <div class="flex items-center gap-sm mb-sm">
                            <span class="text-xs font-bold px-sm py-0.5 rounded-full
                                {{ $freeResource->type === 'note' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700' }}">
                                {{ strtoupper($freeResource->type) }}
                            </span>
                            <span class="text-xs text-on-surface-variant">Class {{ $freeResource->class_level }} • {{ $freeResource->board ?? 'NCERT' }}</span>
                        </div>
                        <h1 class="text-xl font-bold text-primary leading-snug">{{ $freeResource->title }}</h1>
                        @if($freeResource->chapter)
                            <p class="text-sm text-on-surface-variant mt-1">{{ $freeResource->chapter }}</p>
                        @endif
                        @if($freeResource->description)
                            <p class="text-sm text-on-surface-variant mt-sm">{{ $freeResource->description }}</p>
                        @endif
                    </div>
                    <a href="{{ route('notes.download', $freeResource) }}"
                       class="shrink-0 flex items-center gap-sm bg-primary text-white px-lg py-sm rounded-lg text-sm font-semibold hover:bg-secondary transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download PDF
                    </a>
                </div>

                {{-- PDF Viewer --}}
                <div class="bg-gray-100" style="height: 85vh; min-height: 950px;">
                    <iframe
                        src="{{ $freeResource->fileUrl() }}#toolbar=1"
                        class="w-full h-full border-0"
                        title="{{ $freeResource->title }}">
                        <p class="p-lg text-sm text-on-surface-variant">
                            Your browser can't display this PDF inline.
                            <a href="{{ route('notes.download', $freeResource) }}" class="text-primary font-semibold hover:underline">Download it instead</a>.
                        </p>
                    </iframe>
                </div>
            </div>
        </div>

        {{-- ── Sidebar ── --}}
        <div class="space-y-lg">

            {{-- Info card --}}
            <div class="bg-white rounded-xl border border-outline-variant p-lg">
                <h3 class="font-bold text-primary mb-md text-sm">About this resource</h3>
                <div class="space-y-sm text-sm text-on-surface-variant">
                    <div class="flex justify-between">
                        <span>Subject</span>
                        <span class="font-semibold text-primary">{{ $freeResource->subject }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Class</span>
                        <span class="font-semibold text-primary">Class {{ $freeResource->class_level }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Board</span>
                        <span class="font-semibold text-primary">{{ $freeResource->board ?? 'NCERT' }}</span>
                    </div>

                </div>
            </div>

            {{-- Join batch CTA --}}
            <div class="bg-primary rounded-xl p-lg text-white">
                <h3 class="font-bold text-base mb-sm">Want live coaching?</h3>
                <p class="text-blue-100/70 text-xs mb-md leading-relaxed">
                    Join our expert-led batches for Class {{ $freeResource->class_level }} and get live sessions, doubt clearing, and more.
                </p>
                <a href="{{ route('batches.index') }}"
                   class="block text-center bg-white text-primary font-bold py-sm rounded-lg text-sm hover:bg-blue-50 transition-colors">
                    Explore Batches →
                </a>
            </div>

            {{-- Related notes --}}
            @if($related->isNotEmpty())
                <div class="bg-white rounded-xl border border-outline-variant p-lg">
                    <h3 class="font-bold text-primary mb-md text-sm">More {{ $freeResource->subject }} Notes</h3>
                    <div class="space-y-sm">
                        @foreach($related as $rel)
                            <a href="{{ route('notes.show', $rel) }}"
                               class="flex items-center gap-sm p-sm rounded-lg hover:bg-surface-container-low transition-colors group">
                                <div class="w-8 h-8 bg-secondary-fixed rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-primary group-hover:text-secondary transition-colors line-clamp-2">{{ $rel->title }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
