@extends('layouts.admin')

@section('title', 'Teacher Onboarding')

@section('content')
<div class="p-6 max-w-4xl">

    {{-- Breadcrumb + Title --}}
    <nav class="text-xs text-gray-400 mb-1">
        <a href="{{ route('admin.teachers.index') }}" class="hover:text-gray-600">Faculty Management</a>
        <span class="mx-1">›</span>
        <span class="text-gray-600">Register New Teacher</span>
    </nav>
    <h1 class="text-2xl font-bold text-gray-900 mb-0.5">Teacher Onboarding</h1>
    <p class="text-sm text-gray-500 mb-6">Initialize a new academic profile with comprehensive departmental and account details.</p>

    <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data" id="teacher-form">
        @csrf

        {{-- Section 1: Personal Information --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-4">
            <h2 class="text-sm font-bold text-gray-800 mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Personal Information
            </h2>

            <div class="flex items-start gap-6">
                {{-- Profile Photo Upload --}}
                <div class="shrink-0">
                    <label for="profile_photo" class="block cursor-pointer">
                        <div id="photo-preview-wrapper"
                             class="w-24 h-24 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors overflow-hidden">
                            <img id="photo-preview" src="" alt="" class="w-full h-full object-cover hidden rounded-xl">
                            <div id="photo-placeholder" class="flex flex-col items-center">
                                <svg class="w-6 h-6 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-[10px] text-gray-400 text-center leading-tight px-1">PROFILE PHOTO</span>
                            </div>
                        </div>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/jpeg,image/png" class="hidden">
                        <p class="text-[10px] text-gray-400 mt-1.5 text-center">JPG or PNG. Max 2MB.</p>
                    </label>
                </div>

                {{-- Fields --}}
                <div class="flex-1 grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-xs font-semibold text-gray-600 mb-1.5">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               placeholder="e.g. Dr. Robert Harrison"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition @error('name') border-red-300 @enderror">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-600 mb-1.5">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="r.harrison@eduadmin.com"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition @error('email') border-red-300 @enderror">
                        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="phone" class="block text-xs font-semibold text-gray-600 mb-1.5">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                               placeholder="+1 (555) 123-4567"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Academic Credentials --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-4">
            <h2 class="text-sm font-bold text-gray-800 mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
                Academic Credentials
            </h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="highest_degree" class="block text-xs font-semibold text-gray-600 mb-1.5">Highest Degree</label>
                    <select id="highest_degree" name="highest_degree"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer">
                        <option value="">Select Degree</option>
                        <option value="Bachelor's" @selected(old('highest_degree') === "Bachelor's")>Bachelor's</option>
                        <option value="Master's" @selected(old('highest_degree') === "Master's")>Master's</option>
                        <option value="PhD" @selected(old('highest_degree') === 'PhD')>PhD / Doctorate</option>
                        <option value="Postdoc" @selected(old('highest_degree') === 'Postdoc')>Postdoctoral</option>
                    </select>
                </div>
                <div>
                    <label for="institution" class="block text-xs font-semibold text-gray-600 mb-1.5">Institution</label>
                    <input type="text" id="institution" name="institution" value="{{ old('institution') }}"
                           placeholder="e.g. Stanford University"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>
                <div class="col-span-2">
                    <label for="years_of_experience" class="block text-xs font-semibold text-gray-600 mb-1.5">Years of Experience</label>
                    <input type="number" id="years_of_experience" name="years_of_experience"
                           value="{{ old('years_of_experience') }}" placeholder="e.g. 12" min="0" max="60"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>
            </div>
        </div>

        {{-- Section 3: Departmental Assignment --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-4">
            <h2 class="text-sm font-bold text-gray-800 mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Departmental Assignment
            </h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="department" class="block text-xs font-semibold text-gray-600 mb-1.5">Department</label>
                    <select id="department" name="department"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer">
                        <option value="">Select Department</option>
                        <option value="Science" @selected(old('department') === 'Science')>Science</option>
                        <option value="Mathematics" @selected(old('department') === 'Mathematics')>Mathematics</option>
                        <option value="Arts" @selected(old('department') === 'Arts')>Arts & Humanities</option>
                        <option value="Commerce" @selected(old('department') === 'Commerce')>Commerce</option>
                        <option value="Technology" @selected(old('department') === 'Technology')>Technology</option>
                        <option value="Languages" @selected(old('department') === 'Languages')>Languages</option>
                    </select>
                </div>
                <div>
                    <label for="subject" class="block text-xs font-semibold text-gray-600 mb-1.5">Primary Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                           placeholder="e.g. Quantum Physics"
                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 transition">
                </div>
            </div>
        </div>

        {{-- Section 4: Account Settings --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
            <h2 class="text-sm font-bold text-gray-800 mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Account Settings
            </h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-semibold text-gray-600 mb-1.5">Temporary Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 focus:border-[#1e3a5f]/50 pr-10 transition @error('password') border-red-300 @enderror">
                        <button type="button" id="toggle-password"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-[11px] text-gray-400 mt-1">The teacher will be required to change this at first login.</p>
                    @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="role_display" class="block text-xs font-semibold text-gray-600 mb-1.5">Role Assignment</label>
                    <select id="role_display"
                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white appearance-none cursor-pointer" disabled>
                        <option>Faculty Member</option>
                    </select>
                    <p class="text-[11px] text-gray-400 mt-1">Role is automatically set to Teacher.</p>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.teachers.index') }}"
               class="px-5 py-2.5 text-sm font-semibold text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" id="save-teacher-btn"
                    class="flex items-center gap-2 px-5 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Teacher
            </button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
    // Profile photo preview
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            preview.src = evt.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });

    // Password toggle
    document.getElementById('toggle-password').addEventListener('click', function() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    });
</script>
@endpush
