@extends('layouts.teacher')

@section('title', 'Settings')

@section('content')
<div class="p-6 max-w-4xl">
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Account Settings</h1>
        <p class="text-sm text-gray-500 mt-1">Manage your profile, preferences, and notifications.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">

        <form method="POST" action="{{ route('teacher.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 border-b border-gray-100 flex items-center gap-6">
                <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="{{ auth()->user()->name }}"
                     id="avatar-preview" class="w-20 h-20 rounded-full object-cover border border-gray-200">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ auth()->user()->email }} • {{ auth()->user()->department ?? 'Educator' }}</p>
                    <label for="profile_photo" class="inline-block text-sm font-medium text-[#1e3a5f] bg-blue-50 px-3 py-1.5 rounded-md hover:bg-blue-100 transition-colors cursor-pointer">
                        Change Photo
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/png,image/jpeg" class="hidden">
                    @error('profile_photo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="p-6">
            <h4 class="font-bold text-gray-900 mb-4">Personal Information</h4>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address (Read-only)</label>
                    <input type="email" value="{{ auth()->user()->email }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 bg-gray-50 text-gray-500" disabled>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primary Subject</label>
                    <input type="text" name="subject" value="{{ old('subject', auth()->user()->subject) }}" placeholder="e.g. Mathematics" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-[#1e3a5f] focus:border-[#1e3a5f]">
                    @error('subject')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-3 flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Contact your administrator if you need to update your email address.
            </p>
        </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <h4 class="font-bold text-gray-900 mb-4">Notification Preferences</h4>
            <div class="space-y-4">
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="email_notifications" value="1" {{ old('email_notifications', auth()->user()->email_notifications) ? 'checked' : '' }} class="rounded text-[#1e3a5f] focus:ring-[#1e3a5f] w-5 h-5 border-gray-300">
                    <div>
                        <p class="text-sm font-bold text-gray-900">Email Notifications</p>
                        <p class="text-xs text-gray-500">Receive emails for new batch assignments and student queries.</p>
                    </div>
                </label>
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="push_notifications" value="1" {{ old('push_notifications', auth()->user()->push_notifications) ? 'checked' : '' }} class="rounded text-[#1e3a5f] focus:ring-[#1e3a5f] w-5 h-5 border-gray-300">
                    <div>
                        <p class="text-sm font-bold text-gray-900">Push Notifications</p>
                        <p class="text-xs text-gray-500">Receive browser alerts for live session reminders.</p>
                    </div>
                </label>
            </div>
            <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-[#1e3a5f] hover:bg-[#162d4a] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors">
                    Save Preferences
                </button>
            </div>
        </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('profile_photo')?.addEventListener('change', function () {
        if (this.files.length > 0) {
            document.getElementById('avatar-preview').src = URL.createObjectURL(this.files[0]);
        }
    });
</script>
@endpush
@endsection
