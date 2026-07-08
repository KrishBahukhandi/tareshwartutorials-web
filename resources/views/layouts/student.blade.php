<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard') - Tareshwar Tutorials</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f5f7fb] font-sans text-gray-950 antialiased">
@php
    $navItems = [
        ['route' => 'student.dashboard', 'label' => 'Home', 'icon' => 'home', 'active' => request()->routeIs('student.dashboard')],
        ['route' => 'student.enrollments.index', 'label' => 'My Batches', 'icon' => 'book', 'active' => request()->routeIs('student.enrollments.*')],
        ['route' => 'batches.index', 'label' => 'Explore', 'icon' => 'search', 'active' => request()->routeIs('batches.*')],
        ['route' => 'notes.index', 'label' => 'Notes', 'icon' => 'file', 'active' => request()->routeIs('notes.*')],
        ['route' => 'student.settings', 'label' => 'Settings', 'icon' => 'settings', 'active' => request()->routeIs('student.settings')],
    ];
@endphp

<div class="min-h-screen lg:flex">
    <aside class="hidden lg:flex lg:w-64 lg:flex-col lg:border-r lg:border-gray-200 lg:bg-white">
        <div class="flex h-20 items-center gap-3 px-5">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/favicon.png') }}" alt="Tareshwar Tutorials" class="h-10 w-auto">
            </a>
        </div>

        <nav class="flex-1 space-y-1 px-3">
            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition
                          {{ $item['active'] ? 'bg-[#101828] text-white shadow-sm' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-950' }}">
                    <span class="grid h-9 w-9 place-items-center rounded-xl {{ $item['active'] ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-white' }}">
                        @if($item['icon'] === 'home')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 11.5 12 4l9 7.5M5 10v10h14V10"/></svg>
                        @elseif($item['icon'] === 'book')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13M12 6.253C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253M12 6.253C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/></svg>
                        @elseif($item['icon'] === 'search')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"/></svg>
                        @elseif($item['icon'] === 'settings')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h7l5 5v13H7zM14 3v6h5M9 14h8M9 18h5"/></svg>
                        @endif
                    </span>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="p-4">
            <div class="rounded-3xl bg-[#eef7f1] p-4">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-emerald-700">Daily Goal</p>
                <p class="mt-2 text-sm font-semibold leading-5 text-gray-800">Keep your learning streak alive with one class or note today.</p>
                <a href="{{ route('notes.index') }}" class="mt-4 inline-flex rounded-2xl bg-white px-4 py-2 text-xs font-black text-emerald-700 shadow-sm">Open Notes</a>
            </div>
        </div>
    </aside>

    <div class="min-w-0 flex-1">
        <header class="sticky top-0 z-30 border-b border-gray-200 bg-white/95 backdrop-blur">
            <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 lg:hidden">
                    <span class="grid h-10 w-10 place-items-center rounded-2xl bg-[#101828] text-base font-black text-white">T</span>
                    <span class="font-black text-[#101828]">Tareshwar</span>
                </div>

                <div class="hidden min-w-0 flex-1 items-center gap-3 lg:flex">
                    <div class="relative w-full max-w-md">
                        <svg class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"/></svg>
                        <input type="search" placeholder="Search batches, notes, lectures"
                               class="h-11 w-full rounded-2xl border border-gray-200 bg-gray-50 pl-11 pr-4 text-sm font-semibold text-gray-700 placeholder:text-gray-400 focus:border-[#101828] focus:outline-none focus:ring-2 focus:ring-[#101828]/10">
                    </div>
                </div>

                <nav class="hidden items-center gap-2 md:flex lg:hidden">
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}" class="rounded-2xl px-3 py-2 text-xs font-bold {{ $item['active'] ? 'bg-[#101828] text-white' : 'text-gray-500 hover:bg-gray-100' }}">{{ $item['label'] }}</a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-black text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs font-semibold text-gray-400">Student</p>
                    </div>
                    <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="{{ auth()->user()->name }}" class="h-10 w-10 rounded-2xl border border-gray-200 object-cover">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-2xl border border-gray-200 px-3 py-2 text-sm font-bold text-gray-600 hover:bg-gray-50 hover:text-gray-950">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="border-b border-gray-200 bg-white px-4 py-3 md:hidden">
            <div class="flex gap-2 overflow-x-auto">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="shrink-0 rounded-2xl px-3 py-2 text-xs font-bold {{ $item['active'] ? 'bg-[#101828] text-white' : 'bg-gray-100 text-gray-600' }}">{{ $item['label'] }}</a>
                @endforeach
            </div>
        </div>

        @if(session('success'))
            <div class="px-4 pt-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="px-4 pt-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800">
                    <ul class="list-inside list-disc space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
