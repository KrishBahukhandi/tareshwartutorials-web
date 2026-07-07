<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Tareshwar Tutorials</title>
    <meta name="description" content="Sign in to Tareshwar Tutorials Academic Management Platform">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .input-field {
            width: 100%; padding: 12px 16px; font-size: 14px; border: 1.5px solid #e2e8f0;
            border-radius: 10px; outline: none; transition: all 0.2s;
            background: #fafafa;
        }
        .input-field:focus { border-color: #031635; box-shadow: 0 0 0 3px rgba(3,22,53,0.08); background: #fff; }
        .input-field.error { border-color: #ef4444; }
        .btn-primary {
            width: 100%; padding: 13px; background: #031635; color: #fff; font-weight: 700;
            font-size: 15px; border-radius: 10px; border: none; cursor: pointer;
            transition: background 0.2s, transform 0.1s; letter-spacing: 0.01em;
        }
        .btn-primary:hover { background: #0f2d5e; }
        .btn-primary:active { transform: scale(0.98); }
    </style>
</head>
<body class="min-h-screen bg-[#f5f7fa] flex">

    {{-- Left Panel: Branding --}}
    <div class="hidden lg:flex lg:w-5/12 bg-[#031635] flex-col justify-between p-12 relative overflow-hidden">
        {{-- Subtle dot pattern --}}
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative z-10">
            {{-- Logo --}}
            <div class="mb-16">
                <a href="{{ route('home') }}" class="block">
                    <img src="{{ asset('images/favicon.png') }}" alt="Tareshwar Tutorials" class="h-12 w-auto">
                </a>
            </div>

            {{-- Main copy --}}
            <h1 class="text-4xl font-extrabold text-white leading-tight mb-5">
                Welcome back!<br>
                <span class="text-blue-300">Continue your<br>learning journey.</span>
            </h1>
            <p class="text-blue-100/70 text-base leading-relaxed max-w-xs">
                Sign in to access your batches, live sessions, recorded lectures, and study notes — all in one place.
            </p>
        </div>

        {{-- Feature highlights --}}
        <div class="relative z-10 space-y-3">
            <div class="flex items-center gap-4 bg-white/8 border border-white/10 rounded-xl px-5 py-4">
                <div class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.845v6.31a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm">Live Sessions</p>
                    <p class="text-blue-200/60 text-xs">Join Google Meet classes in one click</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white/8 border border-white/10 rounded-xl px-5 py-4">
                <div class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm">Study Materials</p>
                    <p class="text-blue-200/60 text-xs">Download notes &amp; recorded lectures</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-white/8 border border-white/10 rounded-xl px-5 py-4">
                <div class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm">Track Your Progress</p>
                    <p class="text-blue-200/60 text-xs">Monitor batch completion &amp; performance</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel: Form --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 bg-[#031635] rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="font-bold text-[#031635]">Tareshwar Tutorials</span>
            </div>

            <h2 class="text-2xl font-extrabold text-[#031635] mb-1">Welcome back</h2>
            <p class="text-sm text-gray-500 mb-7">Sign in to your account to continue where you left off.</p>

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" id="login-form">
                @csrf

                <div class="space-y-4">
                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="email">Email Address</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               autocomplete="email"
                               class="input-field @error('email') error @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-semibold text-gray-600" for="password">Password</label>
                            <a href="#" class="text-xs text-[#031635] font-semibold hover:underline">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                   placeholder="••••••••"
                                   autocomplete="current-password"
                                   class="input-field pr-11">
                            <button type="button" id="toggle-pwd"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-[#031635] focus:ring-[#031635]/20 cursor-pointer">
                        <label for="remember" class="text-sm text-gray-600 cursor-pointer">Remember me for 30 days</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary mt-6">
                    Sign In
                </button>

                <p class="text-center text-sm text-gray-500 mt-5">
                    New student?
                    <a href="{{ route('register') }}" class="text-[#031635] font-semibold hover:underline">Create a free account</a>
                </p>
            </form>

            <p class="text-center text-xs text-gray-400 mt-8">
                &copy; {{ date('Y') }} Tareshwar Tutorials. All rights reserved.
            </p>
        </div>
    </div>

<script>
    document.getElementById('toggle-pwd').addEventListener('click', function () {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    });
</script>
</body>
</html>
