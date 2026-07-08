<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = trim($__env->yieldContent('title', 'Tareshwar Tutorials'));
        $seoDescription = trim($__env->yieldContent('description', 'Tareshwar Tutorials — CBSE-aligned live batches, free NCERT notes, and previous year question papers for Class 10 and Class 12.'));
        $seoImage = trim($__env->yieldContent('og_image', asset('images/favicon.png')));
        $seoCanonical = trim($__env->yieldContent('canonical', url()->current()));
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="{{ $seoCanonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Tareshwar Tutorials">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    {{-- Organization structured data --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => 'Tareshwar Tutorials',
        'url' => url('/'),
        'logo' => asset('images/favicon.png'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'CN OO18, Sector 19',
            'addressLocality' => 'Panchkula',
            'addressRegion' => 'Haryana',
            'postalCode' => '134113',
            'addressCountry' => 'IN',
        ],
        'sameAs' => [
            'https://www.instagram.com/tareshwartutorials/',
        ],
    ], JSON_UNESCAPED_SLASHES) !!}
    </script>

    @stack('json-ld')

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary-fixed-variant": "#364768",
                        "background": "#f8f9fb",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#001a42",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#00a774",
                        "on-error": "#ffffff",
                        "tertiary-container": "#003320",
                        "tertiary": "#001c10",
                        "on-error-container": "#93000a",
                        "surface-container": "#edeef0",
                        "on-surface": "#191c1e",
                        "surface-bright": "#f8f9fb",
                        "secondary-fixed-dim": "#adc6ff",
                        "primary-container": "#1a2b4b",
                        "surface-variant": "#e1e2e4",
                        "outline": "#75777f",
                        "inverse-surface": "#2e3132",
                        "outline-variant": "#c5c6cf",
                        "on-tertiary-fixed-variant": "#005236",
                        "tertiary-fixed": "#6ffbbe",
                        "secondary-container": "#2170e4",
                        "primary": "#031635",
                        "surface-container-high": "#e7e8ea",
                        "secondary": "#0058be",
                        "tertiary-fixed-dim": "#4edea3",
                        "on-background": "#191c1e",
                        "on-secondary-fixed-variant": "#004395",
                        "secondary-fixed": "#d8e2ff",
                        "surface-tint": "#4e5e81",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#d8e2ff",
                        "inverse-on-surface": "#f0f1f3",
                        "surface-container-low": "#f3f4f6",
                        "on-primary-fixed": "#081b3a",
                        "on-primary-container": "#8293b8",
                        "primary-fixed-dim": "#b6c6ef",
                        "on-tertiary-fixed": "#002113",
                        "on-secondary": "#ffffff",
                        "inverse-primary": "#b6c6ef",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#44474e",
                        "surface": "#f8f9fb",
                        "on-secondary-container": "#fefcff",
                        "error-container": "#ffdad6",
                        "surface-container-highest": "#e1e2e4",
                        "surface-dim": "#d9dadc"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "base": "8px",
                        "xxl": "64px",
                        "xl": "40px",
                        "sm": "8px",
                        "md": "16px",
                        "xs": "4px",
                        "lg": "24px",
                        "gutter": "24px",
                        "container-max": "1280px"
                    },
                    fontFamily: {
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "headline-xl": ["Inter"],
                        "headline-md": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-sm": ["Inter"]
                    },
                    fontSize: {
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "headline-xl": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}]
                    },
                    maxWidth: {
                        "container-max": "1280px"
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .nav-active {
            border-bottom: 2px solid #031635;
            font-weight: 700;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        /* Mega menu subject links */
        .mega-link {
            display: block;
            font-size: 13px;
            color: #44474e;
            padding: 5px 0;
            transition: color 0.15s;
            text-decoration: none;
        }
        .mega-link:hover { color: #031635; font-weight: 600; }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased">
<script>
    let closeTimer = null;
    let activeClass = null;

    function openSubjects(cls) {
        cancelClose();

        // Hide all subject panels first
        ['10','11','12'].forEach(c => {
            const el = document.getElementById('subjects-' + c);
            el.classList.add('opacity-0', 'invisible');
            el.classList.remove('opacity-100', 'visible');
        });

        // Reset active row highlights
        ['10','11','12'].forEach(c => {
            const row = document.getElementById('class-row-' + c);
            if (row) {
                row.classList.remove('bg-surface-container-low', 'text-primary');
                row.classList.add('text-on-surface-variant');
            }
        });

        // Highlight hovered row
        const activeRow = document.getElementById('class-row-' + cls);
        if (activeRow) {
            activeRow.classList.add('bg-surface-container-low', 'text-primary');
            activeRow.classList.remove('text-on-surface-variant');
        }

        // Position subjects panel next to level1
        const level1 = document.getElementById('notes-level1');
        const panel  = document.getElementById('subjects-' + cls);
        if (level1 && panel) {
            const rect = level1.getBoundingClientRect();
            panel.style.top  = rect.top + 'px';
            panel.style.left = (rect.right + 6) + 'px';
        }

        panel.classList.remove('opacity-0', 'invisible');
        panel.classList.add('opacity-100', 'visible');
        activeClass = cls;
    }

    function scheduleClose() {
        closeTimer = setTimeout(() => closeSubjects(), 120);
    }

    function cancelClose() {
        if (closeTimer) { clearTimeout(closeTimer); closeTimer = null; }
    }

    function closeSubjects() {
        if (!activeClass) return;
        const panel = document.getElementById('subjects-' + activeClass);
        if (panel) {
            panel.classList.add('opacity-0', 'invisible');
            panel.classList.remove('opacity-100', 'visible');
        }
        // Reset highlight
        const row = document.getElementById('class-row-' + activeClass);
        if (row) {
            row.classList.remove('bg-surface-container-low', 'text-primary');
            row.classList.add('text-on-surface-variant');
        }
        activeClass = null;
    }
</script>

    {{-- ══════════════════════════════════════════════
         NEW 2-ROW NAVBAR
         Row 1: Logo | Explore Categories | Search | [Portal btn] | User
         Row 2: Explore ▾ | Home | Batches | Notes ▾ | Career | Company ▾
    ══════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">

        {{-- ── Row 1: Top bar ── --}}
        <div class="max-w-[1400px] mx-auto px-4 h-[64px] flex items-center justify-between md:justify-start md:gap-3">

            {{-- Hamburger Menu (Mobile Only) --}}
            <button id="mobile-menu-btn" class="md:hidden flex items-center justify-center w-10 h-10 text-[#1e3a5f] hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0 md:mr-2">
                <img src="{{ asset('images/favicon.png') }}" alt="Tareshwar Tutorials" class="h-10 w-auto">
            </a>

            {{-- Explore Categories button (Hidden on Mobile) --}}
            <div class="relative group shrink-0 hidden md:block">
                <button class="flex items-center gap-2 h-9 px-4 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Explore Categories
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                {{-- Explore dropdown --}}
                <div class="absolute left-0 top-full mt-1.5 w-56 bg-white rounded-xl shadow-xl border border-gray-100
                            opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-1 group-hover:translate-y-0 z-50 py-2">
                    <a href="{{ route('batches.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
                        <span class="font-medium">Live Batches</span>
                    </a>
                    <a href="{{ route('notes.index', ['class' => '10']) }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="font-medium">Class 10 Notes</span>
                    </a>
                    <a href="{{ route('notes.index', ['class' => '11']) }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="font-medium">Class 11 Notes</span>
                    </a>
                    <a href="{{ route('notes.index', ['class' => '12']) }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="font-medium">Class 12 Notes</span>
                    </a>
                    <div class="border-t border-gray-100 mt-1 pt-1">
                        <a href="{{ route('support') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors">
                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span class="font-medium">Support</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Search bar (Hidden on Mobile) --}}
            <form action="{{ route('search') }}" method="GET" class="flex-1 min-w-0 hidden md:block">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search"
                           placeholder="Search batches, notes, PYQs..."
                           value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 h-9 border border-gray-300 rounded-lg text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f] transition-colors bg-gray-50 focus:bg-white">
                </div>
            </form>

            {{-- Right section: auth area --}}
            <div class="flex items-center gap-2 shrink-0">
                @auth
                    @php
                        $portal = match(auth()->user()->role) {
                            'admin'   => ['route' => route('admin.dashboard'),   'label' => 'Admin Portal',   'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                            'teacher' => ['route' => route('teacher.dashboard'), 'label' => 'Teacher Portal', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                            'student' => ['route' => route('student.dashboard'), 'label' => 'Student Portal', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                            default   => ['route' => route('home'),              'label' => 'Dashboard',      'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        };
                        $initials = collect(explode(' ', auth()->user()->name))->map(fn($w) => strtoupper($w[0]))->take(2)->join('');
                    @endphp

                    {{-- Portal shortcut button --}}
                    <a href="{{ $portal['route'] }}"
                       class="hidden lg:flex items-center gap-2 h-9 px-4 bg-gray-100 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-[#1e3a5f] hover:text-white hover:border-[#1e3a5f] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $portal['icon'] }}"/>
                        </svg>
                        {{ $portal['label'] }}
                    </a>

                    {{-- User avatar dropdown --}}
                    <div class="relative group">
                        <button class="flex items-center gap-2 h-9 px-3 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-[#1e3a5f] flex items-center justify-center text-white text-xs font-bold shrink-0">
                                {{ $initials }}
                            </div>
                            <span class="hidden sm:block text-sm font-semibold text-gray-700">Hello, {{ explode(' ', auth()->user()->name)[0] }}</span>
                            <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        {{-- Dropdown --}}
                        <div class="absolute right-0 top-full mt-1.5 w-52 bg-white rounded-xl shadow-xl border border-gray-100
                                    opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-1 group-hover:translate-y-0 z-50 py-2">
                            <div class="px-4 py-2 border-b border-gray-100 mb-1">
                                <p class="text-xs text-gray-400">Signed in as</p>
                                <p class="text-sm font-bold text-[#1e3a5f] truncate">{{ auth()->user()->name }}</p>
                            </div>
                            <a href="{{ $portal['route'] }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-[#1e3a5f] hover:bg-[#1e3a5f] hover:text-white transition-colors rounded-lg mx-1">
                                {{ $portal['label'] }}
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors rounded-lg mx-1">
                                My Notes
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors rounded-lg mx-1">
                                Account Settings
                            </a>
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors rounded-lg mx-1 text-left">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @else
                    <a href="{{ route('login') }}"
                       class="h-9 px-4 flex items-center text-sm font-semibold text-gray-700 hover:text-[#1e3a5f] transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="h-9 px-4 flex items-center bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>

        {{-- ── Row 2: Secondary nav (Hidden on mobile) ── --}}
        <div class="border-t border-gray-100 bg-white hidden md:block">
            <div class="max-w-[1400px] mx-auto px-4 flex items-center justify-center h-[44px] gap-1">


                {{-- Home --}}
                <a href="{{ route('home') }}"
                   class="px-3 h-[44px] flex items-center text-sm font-medium transition-colors
                          {{ request()->routeIs('home') ? 'text-[#1e3a5f] font-bold border-b-2 border-[#1e3a5f]' : 'text-gray-600 hover:text-[#1e3a5f]' }}">
                    Home
                </a>

                {{-- Batches --}}
                <a href="{{ route('batches.index') }}"
                   class="px-3 h-[44px] flex items-center text-sm font-medium transition-colors
                          {{ request()->routeIs('batches.*') ? 'text-[#1e3a5f] font-bold border-b-2 border-[#1e3a5f]' : 'text-gray-600 hover:text-[#1e3a5f]' }}">
                    Batches
                </a>

                {{-- ── Notes 2-Level Dropdown ── --}}
                <div class="relative group" id="notes-menu">
                    <button class="flex items-center gap-1 px-3 h-[44px] text-sm font-medium transition-colors
                                   {{ request()->routeIs('notes.*') ? 'text-[#1e3a5f] font-bold border-b-2 border-[#1e3a5f]' : 'text-gray-600 hover:text-[#1e3a5f]' }}">
                        Notes
                        <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Level 1: Class list --}}
                    <div id="notes-level1"
                         class="absolute left-0 top-full mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                transition-all duration-200 translate-y-1 group-hover:translate-y-0 z-50">
                        <div class="py-2">
                            <p class="px-4 pt-2 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest">NCERT Notes</p>
                            @foreach(['10' => 'Class 10', '11' => 'Class 11', '12' => 'Class 12'] as $cls => $label)
                                <div class="class-row" onmouseenter="openSubjects('{{ $cls }}')" onmouseleave="scheduleClose()">
                                    <a href="{{ route('notes.index', ['class' => $cls]) }}"
                                       id="class-row-{{ $cls }}"
                                       class="flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-[#1e3a5f] hover:bg-gray-50 transition-colors rounded-lg mx-1">
                                        {{ $label }}
                                        <svg class="w-3.5 h-3.5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Level 2 subject panels --}}
                    @foreach([
                        '10' => [
                            'Science & Maths'  => ['Mathematics', 'Science'],
                            'Social Science'   => ['History', 'Geography', 'Political Science', 'Economics'],
                            'Languages'        => ['English', 'Hindi', 'Sanskrit'],
                        ],
                        '11' => [
                            'Science'      => ['Physics', 'Chemistry', 'Mathematics', 'Biology'],
                            'Commerce'     => ['Business Studies', 'Accountancy', 'Economics'],
                            'Humanities'   => ['History', 'Geography', 'Political Science', 'English', 'Hindi'],
                        ],
                        '12' => [
                            'Science'      => ['Physics', 'Chemistry', 'Mathematics', 'Biology'],
                            'Commerce'     => ['Business Studies', 'Accountancy', 'Economics'],
                            'Humanities'   => ['History', 'Geography', 'Political Science', 'English', 'Hindi'],
                        ],
                    ] as $cls => $groups)
                        <div id="subjects-{{ $cls }}"
                             class="fixed bg-white rounded-xl shadow-2xl border border-gray-100 p-5 z-[60] w-[480px]
                                    opacity-0 invisible transition-all duration-150"
                             onmouseenter="cancelClose()" onmouseleave="closeSubjects()">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Class {{ $cls }} Subjects</p>
                            <div class="grid grid-cols-3 gap-x-6 gap-y-3">
                                @foreach($groups as $groupName => $subjects)
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">{{ $groupName }}</p>
                                        @foreach($subjects as $subject)
                                            <a href="{{ route('notes.index', ['class' => $cls, 'subject' => $subject]) }}"
                                               class="mega-link block">{{ $subject }}</a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-100">
                                <a href="{{ route('notes.index', ['class' => $cls]) }}" class="text-[#1e3a5f] font-semibold text-xs hover:underline">
                                    View all Class {{ $cls }} notes →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PYQs Dropdown --}}
                <div class="relative group">
                    <button class="flex items-center gap-1 px-3 h-[44px] text-sm font-medium transition-colors text-gray-600 hover:text-[#1e3a5f]">
                        PYQs
                        <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full mt-1 w-40 bg-white rounded-xl shadow-xl border border-gray-100
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                transition-all duration-200 translate-y-1 group-hover:translate-y-0 z-50 py-2">
                        <a href="{{ route('pyqs.index', ['class' => 10]) }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors rounded-lg mx-1">Class 10</a>
                        <a href="{{ route('pyqs.index', ['class' => 12]) }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors rounded-lg mx-1">Class 12</a>
                    </div>
                </div>

                {{-- Assignments Dropdown --}}
                <div class="relative group">
                    <button class="flex items-center gap-1 px-3 h-[44px] text-sm font-medium transition-colors text-gray-600 hover:text-[#1e3a5f]">
                        Assignments
                        <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full mt-1 w-40 bg-white rounded-xl shadow-xl border border-gray-100
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                transition-all duration-200 translate-y-1 group-hover:translate-y-0 z-50 py-2">
                        <a href="{{ route('assignments.index', ['class' => 10]) }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors rounded-lg mx-1">Class 10</a>
                        <a href="{{ route('assignments.index', ['class' => 12]) }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] transition-colors rounded-lg mx-1">Class 12</a>
                    </div>
                </div>

                {{-- About Us --}}
                <a href="{{ route('about') }}"
                   class="px-3 h-[44px] flex items-center text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-[#1e3a5f] font-bold border-b-2 border-[#1e3a5f]' : 'text-gray-600 hover:text-[#1e3a5f]' }}">
                    About Us
                </a>

                {{-- Contact Us --}}
                <a href="{{ route('contact') }}"
                   class="px-3 h-[44px] flex items-center text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'text-[#1e3a5f] font-bold border-b-2 border-[#1e3a5f]' : 'text-gray-600 hover:text-[#1e3a5f]' }}">
                    Contact Us
                </a>

                {{-- Help & Faq --}}
                <a href="{{ route('support') }}"
                   class="px-3 h-[44px] flex items-center text-sm font-medium transition-colors {{ request()->routeIs('support') ? 'text-[#1e3a5f] font-bold border-b-2 border-[#1e3a5f]' : 'text-gray-600 hover:text-[#1e3a5f]' }}">
                    Help & Faq
                </a>

            </div>
        </div>
    </header>

    {{-- ── Mobile Drawer (Slide-over) ── --}}
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-gray-900/50 z-[60] hidden transition-opacity opacity-0"></div>
    <div id="mobile-menu-drawer" class="fixed inset-y-0 left-0 w-[280px] bg-white z-[70] transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl overflow-y-auto flex flex-col">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <div class="w-8 h-8 rounded-lg bg-[#1e3a5f] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="leading-none">
                    <p class="text-[12px] font-black text-[#1e3a5f] uppercase tracking-tight">Tareshwar</p>
                    <p class="text-[12px] font-black text-[#1e3a5f] uppercase tracking-tight">Tutorials</p>
                </div>
            </a>
            <button id="mobile-menu-close" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-100 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div class="p-4 border-b border-gray-100">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" placeholder="Search batches, notes, PYQs..." value="{{ request('search') }}" class="w-full pl-9 pr-4 h-10 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]">
            </form>
        </div>

        <div class="flex-1 overflow-y-auto py-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] border-l-4 {{ request()->routeIs('home') ? 'border-[#1e3a5f] bg-blue-50/50 text-[#1e3a5f]' : 'border-transparent' }}">Home</a>
            <a href="{{ route('batches.index') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] border-l-4 {{ request()->routeIs('batches.*') ? 'border-[#1e3a5f] bg-blue-50/50 text-[#1e3a5f]' : 'border-transparent' }}">Batches</a>
            
            <div class="px-4 py-3">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Free Notes</p>
                <div class="space-y-1 ml-2">
                    <a href="{{ route('notes.index', ['class' => '10']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 10</a>
                    <a href="{{ route('notes.index', ['class' => '11']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 11</a>
                    <a href="{{ route('notes.index', ['class' => '12']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 12</a>
                </div>
            </div>

            <div class="px-4 py-3">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">PYQs</p>
                <div class="space-y-1 ml-2">
                    <a href="{{ route('pyqs.index', ['class' => '10']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 10</a>
                    <a href="{{ route('pyqs.index', ['class' => '12']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 12</a>
                </div>
            </div>

            <div class="px-4 py-3">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Assignments</p>
                <div class="space-y-1 ml-2">
                    <a href="{{ route('assignments.index', ['class' => '10']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 10</a>
                    <a href="{{ route('assignments.index', ['class' => '12']) }}" class="block py-1.5 text-sm text-gray-600 hover:text-[#1e3a5f]">Class 12</a>
                </div>
            </div>

            <a href="{{ route('about') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] border-l-4 {{ request()->routeIs('about') ? 'border-[#1e3a5f] bg-blue-50/50 text-[#1e3a5f]' : 'border-transparent' }}">About Us</a>
            <a href="{{ route('contact') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] border-l-4 {{ request()->routeIs('contact') ? 'border-[#1e3a5f] bg-blue-50/50 text-[#1e3a5f]' : 'border-transparent' }}">Contact Us</a>
            <a href="{{ route('support') }}" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f] border-l-4 {{ request()->routeIs('support') ? 'border-[#1e3a5f] bg-blue-50/50 text-[#1e3a5f]' : 'border-transparent' }}">Help & Faq</a>
        </div>
        
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            @auth
                <a href="{{ $portal['route'] }}" class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a]">
                    Go to Portal
                </a>
            @else
                <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 mb-2">Sign In</a>
                <a href="{{ route('register') }}" class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a]">Get Started</a>
            @endauth
        </div>
    </div>



    {{-- Main Content --}}
    <main>
        @if(session('success'))
            <div class="max-w-container-max mx-auto px-gutter mt-md">
                <div class="px-md py-sm bg-emerald-50 border border-emerald-200 rounded-lg text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-container-max mx-auto px-gutter mt-md">
                <div class="px-md py-sm bg-red-50 border border-red-200 rounded-lg text-sm text-red-800">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-primary dark:bg-primary-container">
        <div class="max-w-container-max mx-auto px-gutter py-xl mt-xxl flex flex-col md:flex-row justify-between items-start md:items-center w-full gap-xl">
            <div class="space-y-md">
                <span class="font-headline-md text-headline-md font-bold text-on-primary">Tareshwar Tutorials</span>
                <p class="text-on-primary-container max-w-xs font-body-sm text-body-sm">
                    Advanced learning systems for the next generation of academic and professional leaders.
                </p>
                <div class="flex items-start gap-sm text-on-primary-container mt-4">
                    <span class="material-symbols-outlined text-secondary-fixed text-[20px]">location_on</span>
                    <p class="font-body-sm text-body-sm max-w-xs">CN OO18, Sector 19, Panchkula, Haryana 134113</p>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-xl">
                <div class="flex flex-col gap-sm">
                    <h5 class="text-white font-bold text-sm uppercase tracking-wider">Company</h5>
                    <a class="font-body-sm text-body-sm text-on-primary-container dark:text-outline-variant hover:text-on-primary transition-all" href="#">Careers</a>
                    <a class="font-body-sm text-body-sm text-on-primary-container dark:text-outline-variant hover:text-on-primary transition-all" href="{{ route('about') }}">About Us</a>
                </div>
                <div class="flex flex-col gap-sm">
                    <h5 class="text-white font-bold text-sm uppercase tracking-wider">Support</h5>
                    <a class="font-body-sm text-body-sm text-on-primary-container dark:text-outline-variant hover:text-on-primary transition-all" href="{{ route('support') }}">Contact Us</a>
                    <a class="font-body-sm text-body-sm text-on-primary-container dark:text-outline-variant hover:text-on-primary transition-all" href="{{ route('support') }}">Resource Center</a>
                </div>
                <div class="flex flex-col gap-sm">
                    <h5 class="text-white font-bold text-sm uppercase tracking-wider">Legal</h5>
                    <a class="font-body-sm text-body-sm text-on-primary-container dark:text-outline-variant hover:text-on-primary transition-all" href="{{ route('terms') }}">Terms of Service</a>
                    <a class="font-body-sm text-body-sm text-on-primary-container dark:text-outline-variant hover:text-on-primary transition-all" href="{{ route('privacy') }}">Privacy Policy</a>
                </div>
            </div>
        </div>
        <div class="max-w-container-max mx-auto px-gutter py-md border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-md">
            <p class="font-body-sm text-body-sm text-on-primary-container">&copy; {{ date('Y') }} Tareshwar Tutorials. All rights reserved.</p>
                <a class="text-on-primary-container hover:text-white transition-colors" href="https://www.instagram.com/tareshwartutorials/" target="_blank" rel="noopener noreferrer">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </div>
    </footer>

    <script>
        // Intersection observer for reveal animations
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section > div').forEach(el => {
            el.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
            observer.observe(el);
        });

        // Mobile Menu Toggle Logic
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');

        function toggleMobileMenu() {
            const isHidden = mobileMenuOverlay.classList.contains('hidden');
            if (isHidden) {
                // Open menu
                mobileMenuOverlay.classList.remove('hidden');
                // Small delay to allow display:block to apply before animating opacity
                setTimeout(() => {
                    mobileMenuOverlay.classList.remove('opacity-0');
                    mobileMenuDrawer.classList.remove('-translate-x-full');
                }, 10);
            } else {
                // Close menu
                mobileMenuOverlay.classList.add('opacity-0');
                mobileMenuDrawer.classList.add('-translate-x-full');
                // Wait for transition to finish before hiding
                setTimeout(() => {
                    mobileMenuOverlay.classList.add('hidden');
                }, 300);
            }
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        if (mobileMenuClose) mobileMenuClose.addEventListener('click', toggleMobileMenu);
        if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', toggleMobileMenu);
    </script>
</body>
</html>
