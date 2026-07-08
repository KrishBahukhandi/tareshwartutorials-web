<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — EduAdmin Teacher</title>
    <meta name="description" content="EduAdmin Educator Portal">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f4f6fa] font-sans antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-52 min-w-[208px] bg-white flex flex-col border-r border-gray-200 shadow-sm z-30">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-gray-100">
            <a href="{{ route('teacher.dashboard') }}" class="block">
                <img src="{{ asset('images/favicon.png') }}" alt="Tareshwar Tutorials" class="h-10 w-auto">
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5">
            @php
                $navItems = [
                    ['route' => 'teacher.dashboard', 'label' => 'Overview',    'icon' => 'grid'],
                    ['route' => 'teacher.batches.index', 'label' => 'My Batches',  'icon' => 'users'],
                    ['route' => 'teacher.resources', 'label' => 'Resources',   'icon' => 'folder'],
                    ['route' => 'teacher.schedule',  'label' => 'Schedule',    'icon' => 'calendar'],
                    ['route' => 'teacher.settings',  'label' => 'Settings',    'icon' => 'settings'],
                ];
                $currentRoute = request()->route()->getName();
            @endphp

            @foreach ($navItems as $i => $item)
                @php
                    $isActive = match($item['label']) {
                        'Overview'   => $currentRoute === 'teacher.dashboard',
                        'My Batches' => str_starts_with($currentRoute ?? '', 'teacher.batches'),
                        'Resources'  => $currentRoute === 'teacher.resources',
                        'Schedule'   => $currentRoute === 'teacher.schedule',
                        'Settings'   => $currentRoute === 'teacher.settings',
                        default      => false,
                    };
                @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                          {{ $isActive 
                              ? 'bg-[#1e3a5f] text-white shadow-sm'
                              : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    @if($item['icon'] === 'grid')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    @elseif($item['icon'] === 'users')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    @elseif($item['icon'] === 'folder')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                        </svg>
                    @elseif($item['icon'] === 'calendar')
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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

        {{-- Teacher Info at bottom --}}
        <div class="px-3 py-4 border-t border-gray-100">
            <div class="flex items-center gap-2.5 px-2 py-2 rounded-lg bg-gray-50">
                <img src="{{ auth()->user()->profilePhotoUrl() }}"
                     alt="{{ auth()->user()->name }}"
                     class="w-8 h-8 rounded-full object-cover shrink-0">
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Faculty</p>
                </div>
            </div>
        </div>

    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-end gap-4 shrink-0">
            <div class="flex items-center gap-3">
                <a href="{{ route('teacher.settings') }}" class="flex items-center gap-2.5 hover:opacity-80 transition-opacity">
                    <img src="{{ auth()->user()->profilePhotoUrl() }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-9 h-9 rounded-full object-cover border-2 border-gray-200">
                    <span class="text-sm font-semibold text-gray-700">Manage Profile</span>
                </a>

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
        <footer class="bg-white border-t border-gray-200 px-6 py-2 flex items-center text-xs text-gray-400 shrink-0">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-400 rounded-full"></span>
                <span class="font-medium text-emerald-600 uppercase tracking-wide">System Status: Operational</span>
            </div>
        </footer>
    </div>
</div>

@stack('scripts')
</body>
</html>
