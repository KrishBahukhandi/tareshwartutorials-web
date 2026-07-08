@extends('layouts.student')

@section('title', 'Settings')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-4xl">

    <div class="mb-6">
        <h1 class="text-2xl font-black text-gray-950">Account Settings</h1>
        <p class="text-sm text-gray-500 mt-1">Manage your profile, academic details, and notifications.</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-200 shadow-sm overflow-hidden mb-6">

        <form method="POST" action="{{ route('student.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 border-b border-gray-100 flex items-center gap-6">
                <img src="{{ auth()->user()->profilePhotoUrl() }}" alt="{{ auth()->user()->name }}"
                     id="avatar-preview" class="w-20 h-20 rounded-full object-cover border border-gray-200">
                <div>
                    <h3 class="text-lg font-black text-gray-950">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ auth()->user()->email }}</p>
                    <label for="profile_photo" class="inline-block text-sm font-bold text-[#101828] bg-gray-100 px-3 py-1.5 rounded-xl hover:bg-gray-200 transition-colors cursor-pointer">
                        Change Photo
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/png,image/jpeg" class="hidden">
                    @error('profile_photo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="p-6">
                <h4 class="font-black text-gray-900 mb-4">Personal Information</h4>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full rounded-xl border-gray-300 border px-4 py-2 focus:ring-[#101828] focus:border-[#101828]" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email Address (Read-only)</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full rounded-xl border-gray-300 border px-4 py-2 bg-gray-50 text-gray-500" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="e.g. 9876543210" class="w-full rounded-xl border-gray-300 border px-4 py-2 focus:ring-[#101828] focus:border-[#101828]">
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Contact your administrator if you need to update your email address.
                </p>
            </div>

            <div class="p-6 border-t border-gray-100">
                <h4 class="font-black text-gray-900 mb-4">Academic Details</h4>
                <p class="text-xs text-gray-500 mb-4">This helps us recommend the right batches and study material for you.</p>
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Class</label>
                        <select name="class_level" class="w-full rounded-xl border-gray-300 border px-4 py-2 focus:ring-[#101828] focus:border-[#101828]">
                            <option value="">Select class</option>
                            @foreach(['6','7','8','9','10','11','12'] as $cls)
                                <option value="{{ $cls }}" {{ old('class_level', auth()->user()->class_level) === $cls ? 'selected' : '' }}>{{ $cls }}</option>
                            @endforeach
                        </select>
                        @error('class_level')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Board</label>
                        <select name="board" class="w-full rounded-xl border-gray-300 border px-4 py-2 focus:ring-[#101828] focus:border-[#101828]">
                            <option value="">Select board</option>
                            @foreach(['CBSE', 'ICSE', 'State Board'] as $board)
                                <option value="{{ $board }}" {{ old('board', auth()->user()->board) === $board ? 'selected' : '' }}>{{ $board }}</option>
                            @endforeach
                        </select>
                        @error('board')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Stream <span class="font-normal text-gray-400">(11th/12th)</span></label>
                        <select name="stream" class="w-full rounded-xl border-gray-300 border px-4 py-2 focus:ring-[#101828] focus:border-[#101828]">
                            <option value="">Not applicable</option>
                            @foreach(['Science', 'Commerce', 'Arts'] as $stream)
                                <option value="{{ $stream }}" {{ old('stream', auth()->user()->stream) === $stream ? 'selected' : '' }}>{{ $stream }}</option>
                            @endforeach
                        </select>
                        @error('stream')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </div>

    <div class="bg-white rounded-[2rem] border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <h4 class="font-black text-gray-900 mb-4">Notification Preferences</h4>
            <div class="space-y-4">
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="email_notifications" value="1" {{ old('email_notifications', auth()->user()->email_notifications) ? 'checked' : '' }} class="rounded text-[#101828] focus:ring-[#101828] w-5 h-5 border-gray-300">
                    <div>
                        <p class="text-sm font-black text-gray-900">Email Notifications</p>
                        <p class="text-xs text-gray-500">Receive emails about new assignments, grades, and batch updates.</p>
                    </div>
                </label>
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="push_notifications" value="1" {{ old('push_notifications', auth()->user()->push_notifications) ? 'checked' : '' }} class="rounded text-[#101828] focus:ring-[#101828] w-5 h-5 border-gray-300">
                    <div>
                        <p class="text-sm font-black text-gray-900">Push Notifications</p>
                        <p class="text-xs text-gray-500">Receive browser alerts for upcoming live sessions.</p>
                    </div>
                </label>
            </div>
            <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-[#101828] hover:bg-gray-800 text-white px-5 py-2.5 rounded-2xl text-sm font-black transition-colors">
                    Save Changes
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
