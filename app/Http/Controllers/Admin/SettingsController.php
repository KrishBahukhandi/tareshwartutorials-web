<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $logoPath = Setting::get('school_logo');

        return view('admin.settings.index', [
            'admin' => Auth::user(),
            'schoolName' => Setting::get('school_name', config('app.name')),
            'schoolLogoUrl' => $logoPath ? Storage::disk(config('filesystems.public_files'))->url($logoPath) : null,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$admin->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'school_name' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', Password::defaults(), 'confirmed'],
        ]);

        $admin->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->hasFile('profile_photo')) {
            $admin->profile_photo = $request->file('profile_photo')->store('profile-photos', config('filesystems.public_files'));
        }

        if ($request->filled('new_password')) {
            if (! Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $admin->password = Hash::make($request->new_password);
        }

        $admin->save();

        if ($request->filled('school_name')) {
            Setting::set('school_name', $request->school_name);
        }

        if ($request->hasFile('logo')) {
            Setting::set('school_logo', $request->file('logo')->store('branding', config('filesystems.public_files')));
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
