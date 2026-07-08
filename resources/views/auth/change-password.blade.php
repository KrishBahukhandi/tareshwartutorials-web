<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set a New Password — Tareshwar Tutorials</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .input-field {
            width: 100%; padding: 12px 16px; font-size: 14px; border: 1.5px solid #e2e8f0;
            border-radius: 10px; outline: none; transition: all 0.2s;
            background: #fafafa;
        }
        .input-field:focus { border-color: #031635; box-shadow: 0 0 0 3px rgba(3,22,53,0.08); background: #fff; }
        .btn-primary {
            width: 100%; padding: 13px; background: #031635; color: #fff; font-weight: 700;
            font-size: 15px; border-radius: 10px; border: none; cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-primary:hover { background: #0f2d5e; }
        .btn-primary:active { transform: scale(0.98); }
    </style>
</head>
<body class="min-h-screen bg-[#f5f7fa] flex">

    {{-- Left Panel: Branding --}}
    <div class="hidden lg:flex lg:w-5/12 bg-[#031635] flex-col justify-between p-12 relative overflow-hidden">
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative z-10">
            <div class="mb-16">
                <img src="{{ asset('images/favicon.png') }}" alt="Tareshwar Tutorials" class="h-12 w-auto">
            </div>

            <h1 class="text-4xl font-extrabold text-white leading-tight mb-5">
                Welcome aboard!<br>
                <span class="text-blue-300">Let's secure<br>your account.</span>
            </h1>
            <p class="text-blue-100/70 text-base leading-relaxed max-w-xs">
                For your security, you need to set a new password before you can continue.
            </p>
        </div>
    </div>

    {{-- Right Panel: Form --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
        <div class="w-full max-w-md">

            <div class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 bg-[#031635] rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="font-bold text-[#031635]">Tareshwar Tutorials</span>
            </div>

            <h2 class="text-2xl font-extrabold text-[#031635] mb-1">Set a new password</h2>
            <p class="text-sm text-gray-500 mb-7">You're signing in for the first time. Choose a new password to continue to your dashboard.</p>

            @if ($errors->any())
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.change.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="password">New Password</label>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••"
                               autocomplete="new-password"
                               class="input-field">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="••••••••"
                               autocomplete="new-password"
                               class="input-field">
                    </div>
                </div>

                <button type="submit" class="btn-primary mt-6">
                    Set Password &amp; Continue
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full text-center text-sm text-gray-500 hover:text-[#031635] transition-colors">
                    Log out instead
                </button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-8">
                &copy; {{ date('Y') }} Tareshwar Tutorials. All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>
