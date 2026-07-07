<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = User::where('role', 'teacher')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $teacher = User::create([
            ...$data,
            'role' => 'teacher',
            'is_active' => true,
        ]);

        ActivityLog::create([
            'description' => "<strong>{$teacher->name}</strong> was registered as {$teacher->subject} Teacher.",
            'icon' => 'user-plus',
            'color' => 'blue',
        ]);

        return redirect()->route('admin.teachers.index')
            ->with('success', "Teacher {$teacher->name} has been onboarded successfully.");
    }

    public function toggle(User $teacher): RedirectResponse
    {
        $teacher->update(['is_active' => ! $teacher->is_active]);

        $status = $teacher->is_active ? 'enabled' : 'disabled';

        ActivityLog::create([
            'description' => "Teacher <strong>{$teacher->name}</strong> account has been {$status}.",
            'icon' => 'toggle',
            'color' => $teacher->is_active ? 'green' : 'red',
        ]);

        return back()->with('success', "Teacher account has been {$status}.");
    }
}
