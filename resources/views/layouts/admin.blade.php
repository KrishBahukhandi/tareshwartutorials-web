<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — EduAdmin</title>
    <meta name="description" content="EduAdmin Academic Management Platform">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f4f6fa] font-sans antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-52 min-w-[208px] bg-white flex flex-col border-r border-gray-200 shadow-sm z-30">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-gray-100">
            <a href="{{ route('admin.dashboard') }}" class="block">
                <img src="{{ asset('images/favicon.png') }}" alt="Tareshwar Tutorials" class="h-10 w-auto">
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'label' => 'Overview', 'icon' => 'grid'],
                    ['route' => 'admin.teachers.index', 'label' => 'Teachers', 'icon' => 'user'],
                    ['route' => 'admin.batches.index', 'label' => 'Batches', 'icon' => 'users'],
                    ['route' => 'admin.resources.index', 'label' => 'Free Resources', 'icon' => 'book-open'],
                    ['route' => 'admin.settings', 'label' => 'Settings', 'icon' => 'settings'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $isActive = request()->routeIs($item['route'] . '*'); @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150 group
                          {{ $isActive
                              ? 'bg-[#1e3a5f] text-white shadow-sm'
                              : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    @if($item['icon'] === 'grid')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    @elseif($item['icon'] === 'user')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @elseif($item['icon'] === 'users')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    @endif

                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Admin User Info --}}
        <div class="px-3 py-4 border-t border-gray-100">
            <div class="flex items-center gap-2.5 px-2 py-2 rounded-lg bg-gray-50">
                <img src="{{ auth()->user()->profilePhotoUrl() }}"
                     alt="{{ auth()->user()->name }}"
                     class="w-8 h-8 rounded-full object-cover shrink-0">
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Super Admin</p>
                </div>
            </div>
        </div>

        {{-- Support Box --}}
        <div class="px-3 pb-4">
            <div class="bg-[#1e3a5f] rounded-xl p-3 text-center">
                <p class="text-[10px] text-blue-200 mb-1.5">Support available 24/7</p>
                <a href="#" class="block w-full bg-white text-[#1e3a5f] text-xs font-semibold py-1.5 rounded-lg hover:bg-blue-50 transition-colors">
                    Get Help
                </a>
            </div>
        </div>

    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between gap-4 shrink-0">
            <div class="relative flex-1 max-w-sm">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="search" placeholder="@yield('search_placeholder', 'Search...')"
                       class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg
                              focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/40
                              placeholder:text-gray-400 transition">
            </div>

            <div class="flex items-center gap-3">
                {{-- Notification Bell --}}
                <button id="notif-btn" class="relative w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- Help --}}
                <button class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>

                <div class="w-px h-6 bg-gray-200"></div>

                {{-- User Info --}}
                <div class="flex items-center gap-2.5">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800 leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400 leading-tight">Administrator</p>
                    </div>
                    <img src="{{ auth()->user()->profilePhotoUrl() }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-9 h-9 rounded-full object-cover border-2 border-gray-200">
                </div>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mx-6 mt-4 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-lg text-sm text-emerald-800 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mx-6 mt-4 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-800">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>

        {{-- Status Bar --}}
        <footer class="bg-white border-t border-gray-200 px-6 py-2 flex items-center justify-between text-xs text-gray-400 shrink-0">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-400 rounded-full inline-block"></span>
                <span class="font-medium text-emerald-600 uppercase tracking-wide">System Status: Optimal</span>
            </div>
            <span>EduAdmin v2.4.1 • Last database sync: 2 mins ago</span>
        </footer>

    </div>
</div>

@stack('scripts')
</body>
</html>
