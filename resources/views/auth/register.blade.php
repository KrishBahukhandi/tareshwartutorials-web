<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — Tareshwar Tutorials</title>
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
                Your journey to<br>academic excellence<br>
                <span class="text-blue-300">starts here.</span>
            </h1>
            <p class="text-blue-100/70 text-base leading-relaxed max-w-xs">
                Join our community of dedicated students mastering their subjects with expert-led batches, live sessions, and structured notes.
            </p>
        </div>

        {{-- Stats --}}
        <div class="relative z-10 grid grid-cols-2 gap-4">
            <div class="bg-white/8 border border-white/10 rounded-2xl p-5">
                <p class="text-3xl font-extrabold text-white">15+</p>
                <p class="text-blue-200/70 text-sm mt-1">Years Experience</p>
            </div>
            <div class="bg-white/8 border border-white/10 rounded-2xl p-5">
                <p class="text-3xl font-extrabold text-white">1,000+</p>
                <p class="text-blue-200/70 text-sm mt-1">Offline Students Guided</p>
            </div>
            <div class="bg-white/8 border border-white/10 rounded-2xl p-5">
                <p class="text-3xl font-extrabold text-white">100%</p>
                <p class="text-blue-200/70 text-sm mt-1">Commitment to Growth</p>
            </div>
            <div class="bg-white/8 border border-white/10 rounded-2xl p-5">
                <p class="text-3xl font-extrabold text-white">24/7</p>
                <p class="text-blue-200/70 text-sm mt-1">Access to Notes</p>
            </div>
        </div>
    </div>

    {{-- Right Panel: Form --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
        <div class="w-full max-w-md">

            {{-- Back to website --}}
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-[#031635] transition-colors mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to website
            </a>

            {{-- Mobile logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 bg-[#031635] rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="font-bold text-[#031635]">Tareshwar Tutorials</span>
            </a>

            {{-- Progress --}}
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-[#031635] text-white rounded-full flex items-center justify-center text-xs font-bold">1</div>
                        <span class="text-sm font-semibold text-[#031635]">Your Details</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-gray-200 rounded"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center text-xs font-bold">2</div>
                        <span class="text-sm font-medium text-gray-400">Academic Info</span>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-extrabold text-[#031635] mb-1">Create your account</h2>
            <p class="text-sm text-gray-500 mb-7">Fill in your details to get started. It only takes a minute.</p>

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.step1') }}" id="register-form">
                @csrf

                <div class="space-y-4">
                    {{-- Full Name --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="name">Full Name</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Rahul Sharma"
                               class="input-field @error('name') error @enderror">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="email">Email Address</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="rahul@example.com"
                               class="input-field @error('email') error @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="phone">Mobile Number</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-gray-500 font-medium border-r border-gray-200 pr-3">+91</span>
                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="98765 43210"
                                   maxlength="10"
                                   class="input-field pl-16 @error('phone') error @enderror">
                        </div>
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="password">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                   placeholder="Min. 8 characters"
                                   class="input-field pr-11 @error('password') error @enderror">
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
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5" for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Re-enter your password"
                               class="input-field">
                    </div>
                </div>

                <button type="submit" class="btn-primary mt-6">
                    Continue to Academic Info →
                </button>

                <p class="text-center text-sm text-gray-500 mt-5">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#031635] font-semibold hover:underline">Sign In</a>
                </p>
            </form>
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
