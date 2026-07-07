<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('teacher.settings');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
        ]);

        auth()->user()->update($validated);

        return redirect()->route('teacher.settings')->with('success', 'Profile updated successfully.');
    }
}
