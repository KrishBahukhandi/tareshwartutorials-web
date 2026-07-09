<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('student.settings');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'class_level' => 'nullable|string|max:10',
            'board' => 'nullable|string|max:50',
            'stream' => 'nullable|string|max:50',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', config('filesystems.public_files'));
        }

        $validated['email_notifications'] = $request->boolean('email_notifications');
        $validated['push_notifications'] = $request->boolean('push_notifications');

        $user->update($validated);

        return redirect()->route('student.settings')->with('success', 'Profile updated successfully.');
    }
}
