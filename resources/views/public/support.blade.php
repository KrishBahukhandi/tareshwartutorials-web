@extends('layouts.public')

@section('title', 'Help & Support — Tareshwar Tutorials')
@section('description', 'Find answers, browse guides, and contact our support team.')

@section('content')

{{-- ── Hero / Search Section ── --}}
<section class="relative overflow-hidden bg-primary py-xxl">
    <div class="max-w-container-max mx-auto px-gutter relative z-10 text-center">
        <h1 class="font-headline-lg text-headline-lg text-on-primary mb-md">How can we help you?</h1>
        <p class="font-body-lg text-body-lg text-on-primary-container max-w-xl mx-auto mb-xl">
            Search our knowledge base for answers, or browse by category below.
        </p>
        <form action="{{ route('support') }}" method="GET" class="max-w-2xl mx-auto relative">
            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">search</span>
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search for articles, topics, or keywords..."
                   class="w-full pl-12 pr-md py-md rounded-xl bg-white text-on-surface text-body-md placeholder:text-outline border-0 focus:ring-2 focus:ring-secondary shadow-xl outline-none">
            
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
        </form>
    </div>
</section>

{{-- ── Category Cards ── --}}
<section class="bg-surface-container-low py-xxl">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg">
            @php
                $categories = [
                    ['name' => 'Account', 'icon' => 'manage_accounts', 'desc' => 'Profile settings, password resets, and notifications.'],
                    ['name' => 'Payments', 'icon' => 'payments', 'desc' => 'Billing, subscriptions, invoices, and refund policies.'],
                    ['name' => 'Learning Portal', 'icon' => 'school', 'desc' => 'Course access, assignments, and certificates.'],
                    ['name' => 'Technical Issues', 'icon' => 'build', 'desc' => 'Troubleshooting app errors, video playback, and sync.'],
                ];
            @endphp

            @foreach($categories as $cat)
                @php
                    $isActive = request('category') === $cat['name'];
                @endphp
                <a href="{{ route('support', ['category' => $isActive ? null : $cat['name'], 'search' => request('search')]) }}" 
                   class="{{ $isActive ? 'bg-secondary-container border-secondary ring-2 ring-secondary' : 'bg-white border-outline-variant hover:shadow-xl hover:-translate-y-1' }} rounded-xl shadow-md p-lg text-center transition-all duration-300 border group block relative">
                   
                    @if($isActive)
                        <div class="absolute top-sm right-sm text-secondary">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        </div>
                    @endif

                    <div class="w-12 h-12 mx-auto {{ $isActive ? 'bg-white' : 'bg-secondary-fixed' }} rounded-full flex items-center justify-center mb-md shadow-sm">
                        <span class="material-symbols-outlined text-primary">{{ $cat['icon'] }}</span>
                    </div>
                    <h3 class="font-headline-md text-[18px] text-primary mb-xs">{{ $cat['name'] }}</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $cat['desc'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Main Content: Articles + Sidebar ── --}}
<section class="py-xxl bg-white">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="grid lg:grid-cols-3 gap-xxl">

            {{-- Top Articles --}}
            {{-- Dynamic Topics List --}}
            <div class="lg:col-span-2">
                <div class="flex justify-between items-center mb-xl">
                    <h2 class="font-headline-lg text-headline-lg text-primary">
                        @if(request('search'))
                            Search Results for "{{ request('search') }}"
                        @elseif(request('category'))
                            {{ request('category') }} Topics
                        @else
                            Top Articles
                        @endif
                    </h2>
                    @if(request('search') || request('category'))
                        <a href="{{ route('support') }}" class="text-secondary font-bold flex items-center gap-xs hover:underline decoration-2 underline-offset-4 font-body-sm">
                            Clear Filters
                            <span class="material-symbols-outlined text-[18px]">close</span>
                        </a>
                    @else
                        <a href="#" class="text-secondary font-bold flex items-center gap-xs hover:underline decoration-2 underline-offset-4 font-body-sm">
                            View All
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    @endif
                </div>

                <div class="space-y-md">
                    @forelse($topics as $topic)
                        <details class="group p-md rounded-xl bg-white border border-outline-variant hover:shadow-md hover:border-secondary/30 transition-all duration-200 cursor-pointer marker:hidden">
                            <summary class="flex items-center gap-md list-none outline-none">
                                <div class="w-10 h-10 rounded-lg bg-surface-container-low border border-outline-variant flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">{{ $topic['icon'] }}</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-primary group-hover:text-secondary transition-colors">{{ $topic['title'] }}</h3>
                                    <div class="flex items-center gap-lg text-on-surface-variant mt-xs" style="font-size: 12px;">
                                        <span class="flex items-center gap-xs bg-surface-container-low px-2 py-0.5 rounded-full border border-outline-variant text-[10px] font-bold uppercase tracking-wider text-primary">
                                            {{ $topic['category'] }}
                                        </span>
                                        <span class="flex items-center gap-xs">
                                            <span class="material-symbols-outlined" style="font-size:14px">visibility</span>{{ $topic['views'] }}
                                        </span>
                                        <span class="flex items-center gap-xs">
                                            <span class="material-symbols-outlined" style="font-size:14px">schedule</span>{{ $topic['read_time'] }}
                                        </span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-on-surface-variant group-open:rotate-180 transition-transform">expand_more</span>
                            </summary>
                            <div class="mt-md pt-md border-t border-outline-variant font-body-sm text-body-sm text-on-surface-variant leading-relaxed pl-[56px]">
                                {{ $topic['content'] }}
                            </div>
                        </details>
                    @empty
                        <div class="text-center py-xxl border-2 border-dashed border-outline-variant rounded-xl bg-surface-container-low">
                            <span class="material-symbols-outlined text-outline text-4xl mb-sm block">search_off</span>
                            <h3 class="font-headline-md text-primary mb-xs">No topics found</h3>
                            <p class="font-body-sm text-on-surface-variant">We couldn't find any articles matching your search criteria.</p>
                            <a href="{{ route('support') }}" class="inline-block mt-md text-secondary font-bold hover:underline">Clear Filters</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Popular Searches (Moved from Sidebar) --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-outline-variant p-lg shadow-sm sticky top-24">
                    <h3 class="font-label-md text-on-surface-variant uppercase tracking-wider mb-md">Popular Searches</h3>
                    <div class="flex flex-wrap gap-sm">
                        <a href="{{ route('support', ['search' => 'password']) }}" class="px-md py-xs bg-surface-container-low border border-outline-variant rounded-full font-body-sm text-body-sm text-on-surface hover:bg-surface-container hover:border-secondary transition-colors">Reset Password</a>
                        <a href="{{ route('support', ['search' => 'receipts']) }}" class="px-md py-xs bg-surface-container-low border border-outline-variant rounded-full font-body-sm text-body-sm text-on-surface hover:bg-surface-container hover:border-secondary transition-colors">Receipts</a>
                        <a href="{{ route('support', ['search' => 'video']) }}" class="px-md py-xs bg-surface-container-low border border-outline-variant rounded-full font-body-sm text-body-sm text-on-surface hover:bg-surface-container hover:border-secondary transition-colors">Video Lag</a>
                        <a href="{{ route('support', ['search' => 'live session']) }}" class="px-md py-xs bg-surface-container-low border border-outline-variant rounded-full font-body-sm text-body-sm text-on-surface hover:bg-surface-container hover:border-secondary transition-colors">Live Session</a>
                        <a href="{{ route('support', ['search' => 'certificate']) }}" class="px-md py-xs bg-surface-container-low border border-outline-variant rounded-full font-body-sm text-body-sm text-on-surface hover:bg-surface-container hover:border-secondary transition-colors">Certificate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Stats Bar ── --}}
<section class="bg-surface-container-low border-t border-outline-variant py-xl">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-xl text-center">
            <div>
                <p class="font-headline-lg text-headline-lg text-primary mb-xs">98%</p>
                <p class="font-label-md text-on-surface-variant">Satisfaction Rate</p>
            </div>
            <div>
                <p class="font-headline-lg text-headline-lg text-primary mb-xs">24/7</p>
                <p class="font-label-md text-on-surface-variant">Expert Assistance</p>
            </div>
            <div>
                <p class="font-headline-lg text-headline-lg text-primary mb-xs">500+</p>
                <p class="font-label-md text-on-surface-variant">Articles &amp; Guides</p>
            </div>
        </div>
    </div>
</section>

@endsection
