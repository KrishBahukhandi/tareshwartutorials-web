@extends('layouts.public')

@section('title', 'Previous Year Questions (PYQs) Class ' . $classLevel . ($subject ? ' — ' . $subject : '') . ' | Tareshwar Tutorials')
@section('description', 'CBSE Class ' . $classLevel . ($subject ? ' ' . $subject : '') . ' previous year question papers, free to download — practice with real board exam papers.')

@section('content')

{{-- ── Hero ── --}}
<section class="bg-primary py-xl">
    <div class="max-w-container-max mx-auto px-gutter">
        <p class="text-sm text-blue-200/70 mb-1">Board Exam Prep</p>
        <h1 class="text-3xl font-extrabold text-white mb-2">
            CBSE Class {{ $classLevel }} Previous Year Question Papers{{ $subject ? ': ' . $subject : '' }}
        </h1>
        <p class="text-blue-100/70 text-sm max-w-3xl">Download authentic past papers to boost your exam readiness. Practicing PYQs is the most effective way to understand board exam patterns and score high marks.</p>
    </div>
</section>

{{-- ── Class Tabs (Restricted to 10 and 12) ── --}}
<div class="bg-white border-b border-outline-variant sticky top-[57px] z-40 shadow-sm">
    <div class="max-w-container-max mx-auto px-gutter flex gap-0 overflow-x-auto">
        @foreach(['10' => 'Class 10 PYQs', '12' => 'Class 12 PYQs'] as $cls => $label)
            <a href="{{ route('pyqs.index', ['class' => $cls]) }}"
               class="shrink-0 px-xl py-md text-sm font-bold border-b-[3px] transition-colors
                      {{ $classLevel === $cls
                          ? 'border-primary text-primary bg-primary/5'
                          : 'border-transparent text-on-surface-variant hover:text-primary hover:bg-gray-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

{{-- ── Subject Filter Pills ── --}}
<div class="bg-surface-container-low border-b border-outline-variant">
    <div class="max-w-container-max mx-auto px-gutter py-sm flex flex-wrap gap-sm">
        @foreach($subjects as $sub)
            <a href="{{ route('pyqs.index', ['class' => $classLevel, 'subject' => $sub]) }}"
               class="px-md py-1.5 rounded-full text-xs font-semibold border transition-colors
                      {{ $subject === $sub ? 'bg-primary text-white border-primary' : 'border-outline-variant text-on-surface-variant hover:border-primary hover:text-primary' }}">
                {{ $sub }}
                <span class="{{ $subject === $sub ? 'text-blue-100' : 'text-gray-400' }}">({{ $counts[$sub] ?? 0 }})</span>
            </a>
        @endforeach
    </div>
</div>

{{-- ── Main Academic Layout ── --}}
<section class="py-xl bg-background min-h-[600px]">
    <div class="max-w-container-max mx-auto px-gutter">

        @if(! $subject)
            {{-- Subject picker --}}
            <div class="max-w-3xl mx-auto mt-lg">
                <h2 class="text-xl font-bold text-primary mb-lg text-center">Choose a subject to view its question papers</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-lg">
                    @foreach($subjects as $sub)
                        @php $count = $counts[$sub] ?? 0; @endphp
                        <a href="{{ route('pyqs.index', ['class' => $classLevel, 'subject' => $sub]) }}"
                           class="bg-white rounded-xl border border-outline-variant shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-lg flex items-center gap-md group">
                            <span class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[24px] text-secondary">history_edu</span>
                            </span>
                            <div class="flex-1">
                                <h3 class="font-bold text-primary group-hover:text-secondary transition-colors">{{ $sub }}</h3>
                                <p class="text-xs text-on-surface-variant mt-0.5">
                                    {{ $count > 0 ? $count . ' ' . Str::plural('paper', $count) . ' available' : 'Coming soon' }}
                                </p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chevron_right</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @elseif($resources->isEmpty())
            {{-- Empty state: subject chosen but no papers yet --}}
            <div class="text-center py-xxl bg-white rounded-2xl border border-outline-variant shadow-sm max-w-2xl mx-auto mt-lg">
                <div class="w-20 h-20 bg-secondary-fixed rounded-full flex items-center justify-center mx-auto mb-lg">
                    <span class="material-symbols-outlined text-[40px] text-secondary">history_edu</span>
                </div>
                <h3 class="text-xl font-bold text-primary mb-sm">{{ $subject }} PYQs coming soon!</h3>
                <p class="text-on-surface-variant text-sm max-w-sm mx-auto mb-lg">
                    We're currently digitizing and uploading {{ $subject }} board papers for Class {{ $classLevel }}. Check back soon!
                </p>
                <a href="{{ route('pyqs.index', ['class' => $classLevel]) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline">
                    ← Browse other subjects
                </a>
            </div>
        @else
            {{-- Single-subject academic list view --}}
            <div class="mt-lg">
                <a href="{{ route('pyqs.index', ['class' => $classLevel]) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline mb-md">
                    ← All subjects
                </a>

                <div class="mb-4">
                    <h2 class="text-2xl font-extrabold text-primary mb-2">
                        Class {{ $classLevel }} {{ $subject }} Previous Year Question Papers
                    </h2>
                    <p class="text-sm text-on-surface-variant">
                        Download free PDF of {{ $subject }} past year papers with solutions to practice for your board exams.
                    </p>
                </div>

                <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="hidden sm:grid grid-cols-12 gap-4 px-6 py-3 bg-gray-50 border-b border-outline-variant text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <div class="col-span-8">Question Paper</div>
                        <div class="col-span-2 text-center">Board</div>
                        <div class="col-span-2 text-right">Action</div>
                    </div>

                    <ul class="divide-y divide-outline-variant">
                        @foreach($resources as $resource)
                            <li class="group hover:bg-blue-50/50 transition-colors">
                                <div class="px-6 py-4 flex flex-col sm:grid sm:grid-cols-12 sm:gap-4 sm:items-center">

                                    {{-- Title / Year --}}
                                    <div class="col-span-8 mb-3 sm:mb-0">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                                            </span>
                                            <div>
                                                <a href="{{ route('notes.show', $resource) }}" class="text-base font-bold text-[#1e3a5f] group-hover:text-blue-700 transition-colors">
                                                    {{ $resource->title }}
                                                </a>
                                                <div class="flex items-center gap-3 mt-0.5 text-xs text-gray-500">
                                                    <span class="font-medium bg-gray-100 px-2 py-0.5 rounded">Year: {{ $resource->year ?? 'N/A' }}</span>
                                                    <span class="flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[14px]">download</span>
                                                        {{ $resource->download_count }} downloads
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Board --}}
                                    <div class="col-span-2 text-left sm:text-center mb-3 sm:mb-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $resource->board ?? 'NCERT' }}
                                        </span>
                                    </div>

                                    {{-- Action Button --}}
                                    <div class="col-span-2 text-left sm:text-right">
                                        <a href="{{ route('notes.show', $resource) }}"
                                           class="inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-bold text-white bg-primary rounded-lg hover:bg-[#152a45] transition-colors shadow-sm w-full sm:w-auto">
                                            View PDF
                                        </a>
                                    </div>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Bottom CTA Banner --}}
                <div class="mt-xl bg-gradient-to-br from-primary to-[#152a45] rounded-2xl p-8 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-6 shadow-lg">
                    <div>
                        <h3 class="text-2xl font-black text-white mb-2">Need help solving these?</h3>
                        <p class="text-blue-100 text-sm">Join our specialized board prep batches where our experts break down every PYQ step-by-step.</p>
                    </div>
                    <a href="{{ route('batches.index') }}"
                       class="shrink-0 bg-white text-primary font-extrabold px-6 py-3 rounded-xl hover:bg-blue-50 transition-colors shadow-md">
                        Explore Batches
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
