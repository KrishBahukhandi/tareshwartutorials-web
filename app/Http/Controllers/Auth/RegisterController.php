<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show Step 1 — Personal Details (Name, Email, Phone, Password).
     */
    public function showStep1(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Process Step 1 — validate and store in session, redirect to Step 2.
     */
    public function storeStep1(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'phone'                 => ['required', 'string', 'max:15'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique'          => 'This email is already registered. Please sign in.',
            'password.confirmed'    => 'Passwords do not match.',
        ]);

        // Store Step 1 data in session
        $request->session()->put('register.step1', $validated);

        return redirect()->route('register.step2');
    }

    /**
     * Show Step 2 — Academic Details (Class, Board, Stream).
     */
    public function showStep2(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // If Step 1 hasn't been completed, go back
        if (! session()->has('register.step1')) {
            return redirect()->route('register')->withErrors(['step' => 'Please complete Step 1 first.']);
        }

        return view('auth.register-academic');
    }

    /**
     * Process Step 2 — create the student account and log them in.
     */
    public function storeStep2(Request $request): RedirectResponse
    {
        if (! session()->has('register.step1')) {
            return redirect()->route('register');
        }

        $classLevel = $request->input('class_level');

        $rules = [
            'class_level' => ['required', 'string'],
            'board'       => ['required', 'string'],
        ];

        // Stream is required only for Class 11 and 12
        if (in_array($classLevel, ['11', '12'])) {
            $rules['stream'] = ['required', 'string'];
        }

        $validated = $request->validate($rules);

        $step1 = session('register.step1');

        $user = User::create([
            'name'        => $step1['name'],
            'email'       => $step1['email'],
            'phone'       => $step1['phone'],
            'password'    => Hash::make($step1['password']),
            'role'        => 'student',
            'is_active'   => true,
            'class_level' => $validated['class_level'],
            'board'       => $validated['board'],
            'stream'      => $validated['stream'] ?? null,
        ]);

        // Clean up session and log in
        $request->session()->forget('register.step1');

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.dashboard');
    }
}
