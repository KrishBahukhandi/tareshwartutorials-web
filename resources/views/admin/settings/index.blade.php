@extends('layouts.admin')

@section('title', 'Administrator Settings')
@section('search_placeholder', 'Search settings or tools...')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Administrator Settings</h1>
        <p class="text-sm text-gray-500 mt-0.5">Manage your institution's configuration, security protocols, and personal profile.</p>
    </div>

    <div class="flex gap-5">

        {{-- Left Tab Navigation --}}
        <div class="w-52 shrink-0">
            <nav class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @php
                    $tabs = [
                        ['id' => 'general', 'label' => 'General', 'icon' => 'settings'],
                        ['id' => 'profile', 'label' => 'Profile', 'icon' => 'user-circle'],
                        ['id' => 'security', 'label' => 'Security', 'icon' => 'shield'],
                        ['id' => 'notifications', 'label' => 'Notifications', 'icon' => 'bell'],
                    ];
                    $activeTab = request('tab', 'general');
                @endphp

                @foreach($tabs as $tab)
                    <a href="{{ route('admin.settings') }}?tab={{ $tab['id'] }}"
                       class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium transition-colors border-b border-gray-50 last:border-0
                              {{ $activeTab === $tab['id']
                                  ? 'bg-[#1e3a5f]/5 text-[#1e3a5f] border-l-2 border-l-[#1e3a5f]'
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                        @if($tab['icon'] === 'settings')
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        @elseif($tab['icon'] === 'user-circle')
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @elseif($tab['icon'] === 'shield')
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        @else
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        @endif

                        {{ $tab['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Right Content Panel --}}
        <div class="flex-1 min-w-0">
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settings-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="tab" value="{{ $activeTab }}">

                {{-- Profile Card --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-4 flex items-center gap-5">
                    <div class="relative shrink-0">
                        <img src="{{ $admin->profilePhotoUrl() }}"
                             alt="{{ $admin->name }}"
                             class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                        <label for="profile_photo"
                               class="absolute bottom-0 right-0 w-6 h-6 bg-[#1e3a5f] rounded-full flex items-center justify-center cursor-pointer hover:bg-[#162d4a] transition-colors">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-lg font-bold text-gray-900">{{ $admin->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $admin->subject ?? 'Chief Academic Officer' }} & Super Admin</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 flex-1">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                        </div>
                    </div>
                </div>

                {{-- General Settings --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-4">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        General Settings
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">School Name</label>
                            <input type="text" name="school_name" value="{{ old('school_name', config('app.school_name', 'Global Academy of Excellence')) }}"
                                   class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Institution Branding Logo</label>
                            <label for="logo_upload"
                                   class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <p class="text-sm font-medium text-gray-600">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-400 mt-0.5">SVG, PNG, or JPG (max. 800×400px)</p>
                                <input type="file" id="logo_upload" name="logo" class="hidden" accept=".svg,.png,.jpg">
                            </label>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Primary Language</label>
                            <div class="relative">
                                <select name="language"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer pr-8">
                                    <option value="en-GB">English (United Kingdom)</option>
                                    <option value="en-US">English (United States)</option>
                                    <option value="hi">Hindi</option>
                                    <option value="ar">Arabic</option>
                                </select>
                                <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Security & Access --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-4">
                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Security & Access
                    </h3>

                    {{-- 2FA Toggle --}}
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl mb-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Two-Factor Authentication (2FA)</p>
                            <p class="text-xs text-gray-500 mt-0.5">Add an extra layer of security to your account.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="two_factor_enabled" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer
                                        peer-checked:after:translate-x-full peer-checked:after:border-white
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border-gray-300 after:border after:rounded-full
                                        after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    {{-- Change Password --}}
                    <div class="border border-gray-200 rounded-xl p-4 space-y-3">
                        <p class="text-sm font-semibold text-gray-700">Change Account Password</p>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Current Password</label>
                            <input type="password" name="current_password"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 transition">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">New Password</label>
                                <input type="password" name="new_password"
                                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Confirm Password</label>
                                <input type="password" name="new_password_confirmation"
                                       class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 transition">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sticky Footer --}}
                <div class="bg-white border-t border-gray-200 rounded-xl shadow-sm px-5 py-3.5 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        @if(session('success'))
                            Last saved just now
                        @else
                            Last saved 4 minutes ago
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.settings') }}"
                           class="px-4 py-2 text-sm font-semibold text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            Discard
                        </a>
                        <button type="submit"
                                class="px-5 py-2 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
