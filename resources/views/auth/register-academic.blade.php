<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Details — Tareshwar Tutorials</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Class grid items */
        .class-btn {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 8px;
            text-align: center;
            font-weight: 700;
            font-size: 15px;
            color: #64748b;
            cursor: pointer;
            transition: all 0.18s;
            background: #fff;
            user-select: none;
        }
        .class-btn:hover { border-color: #031635; color: #031635; background: #f0f4ff; }
        .class-btn.selected { border-color: #031635; color: #fff; background: #031635; }

        /* Board & stream options */
        .option-card {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: #64748b;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
        }
        .option-card:hover { border-color: #031635; color: #031635; background: #f0f4ff; }
        .option-card.selected { border-color: #031635; background: #031635; color: #fff; }
        .option-card .dot {
            width: 18px; height: 18px; border-radius: 50%;
            border: 2px solid currentColor; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .option-card.selected .dot::after {
            content: ''; display: block;
            width: 8px; height: 8px; border-radius: 50%; background: #fff;
        }

        .btn-primary {
            width: 100%; padding: 13px; background: #031635; color: #fff; font-weight: 700;
            font-size: 15px; border-radius: 10px; border: none; cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-primary:hover { background: #0f2d5e; }
        .btn-primary:active { transform: scale(0.98); }
        .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }

        .section-fade { transition: opacity 0.25s, transform 0.25s; }
        .section-hidden { opacity: 0; pointer-events: none; max-height: 0; overflow: hidden; }
        .section-visible { opacity: 1; pointer-events: auto; max-height: 500px; overflow: visible; }
    </style>
</head>
<body class="min-h-screen bg-[#f5f7fa] flex">

    {{-- Left Panel: Branding --}}
    <div class="hidden lg:flex lg:w-5/12 bg-[#031635] flex-col justify-between p-12 relative overflow-hidden">
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 28px 28px;"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-16">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center border border-white/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-xl">Tareshwar Tutorials</span>
            </div>

            <h1 class="text-4xl font-extrabold text-white leading-tight mb-5">
                Almost there!<br>
                <span class="text-blue-300">Tell us about<br>your studies.</span>
            </h1>
            <p class="text-blue-100/70 text-base leading-relaxed max-w-xs">
                We'll personalise your experience — recommending the right batches, notes, and sessions for your class and board.
            </p>
        </div>

        {{-- Step indicator --}}
        <div class="relative z-10 bg-white/8 border border-white/10 rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-white/20 text-white rounded-full flex items-center justify-center text-sm font-bold">✓</div>
                <div>
                    <p class="text-white font-semibold text-sm">Step 1 — Your Details</p>
                    <p class="text-blue-200/60 text-xs">Completed</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-white text-[#031635] rounded-full flex items-center justify-center text-sm font-bold">2</div>
                <div>
                    <p class="text-white font-semibold text-sm">Step 2 — Academic Info</p>
                    <p class="text-blue-200/60 text-xs">In progress</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel: Form --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12 overflow-y-auto">
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

            {{-- Progress --}}
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-green-500 text-white rounded-full flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-sm font-medium text-gray-400">Your Details</span>
                    </div>
                    <div class="flex-1 h-0.5 bg-[#031635] rounded"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-[#031635] text-white rounded-full flex items-center justify-center text-xs font-bold">2</div>
                        <span class="text-sm font-semibold text-[#031635]">Academic Info</span>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-extrabold text-[#031635] mb-1">Your academic details</h2>
            <p class="text-sm text-gray-500 mb-7">Select your class, board, and stream (if applicable).</p>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.step2.store') }}" id="academic-form">
                @csrf

                {{-- Hidden inputs populated by JS --}}
                <input type="hidden" name="class_level" id="class_level_input">
                <input type="hidden" name="board" id="board_input">
                <input type="hidden" name="stream" id="stream_input">

                {{-- ── Step A: Choose Class ── --}}
                <div class="mb-7">
                    <p class="text-sm font-bold text-[#031635] mb-3">Which class are you in?</p>
                    <div class="grid grid-cols-4 gap-2.5" id="class-grid">
                        @foreach(['6','7','8','9','10','11','12'] as $cls)
                            <button type="button"
                                    class="class-btn {{ old('class_level') === $cls ? 'selected' : '' }}"
                                    data-class="{{ $cls }}"
                                    onclick="selectClass(this)">
                                {{ $cls }}{{ $cls === '12' ? ' (PCM/PCB)' : '' }}
                            </button>
                        @endforeach
                    </div>
                    @error('class_level')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- ── Step B: Choose Board (shown after class selected) ── --}}
                <div id="board-section" class="mb-7 section-fade section-hidden">
                    <p class="text-sm font-bold text-[#031635] mb-3">Select your board</p>
                    <div class="space-y-2.5">
                        @foreach(['CBSE' => 'Central Board of Secondary Education', 'ICSE' => 'Indian Certificate of Secondary Education', 'State Board' => 'State Board (Maharashtra / UP / others)'] as $code => $label)
                            <button type="button"
                                    class="option-card w-full {{ old('board') === $code ? 'selected' : '' }}"
                                    data-board="{{ $code }}"
                                    onclick="selectBoard(this)">
                                <span class="dot"></span>
                                <div class="text-left">
                                    <p class="font-bold" style="font-size:13px;">{{ $code }}</p>
                                    <p style="font-size:11px; opacity:0.7; font-weight:400;">{{ $label }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @error('board')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- ── Step C: Choose Stream (only for 11 & 12) ── --}}
                <div id="stream-section" class="mb-7 section-fade section-hidden">
                    <p class="text-sm font-bold text-[#031635] mb-3">Select your stream</p>
                    <div class="grid grid-cols-3 gap-2.5">
                        @foreach(['Science' => '🔬', 'Commerce' => '📊', 'Arts' => '🎨'] as $stream => $emoji)
                            <button type="button"
                                    class="option-card flex-col justify-center py-5 {{ old('stream') === $stream ? 'selected' : '' }}"
                                    data-stream="{{ $stream }}"
                                    onclick="selectStream(this)">
                                <span class="text-2xl mb-1">{{ $emoji }}</span>
                                <span>{{ $stream }}</span>
                            </button>
                        @endforeach
                    </div>
                    @error('stream')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                </div>

                <button type="submit" id="submit-btn" class="btn-primary" disabled>
                    Complete Registration →
                </button>

                <p class="text-center text-xs text-gray-400 mt-4">
                    <a href="{{ route('register') }}" class="hover:text-[#031635] transition-colors">← Go back to Step 1</a>
                </p>
            </form>
        </div>
    </div>

<script>
    let selectedClass = null;
    let selectedBoard = null;
    let selectedStream = null;

    function selectClass(el) {
        // Deselect all
        document.querySelectorAll('.class-btn').forEach(b => b.classList.remove('selected'));
        el.classList.add('selected');

        selectedClass = el.dataset.class;
        document.getElementById('class_level_input').value = selectedClass;

        // Reset board & stream
        selectedBoard = null;
        selectedStream = null;
        document.getElementById('board_input').value = '';
        document.getElementById('stream_input').value = '';
        document.querySelectorAll('.option-card[data-board]').forEach(b => b.classList.remove('selected'));
        document.querySelectorAll('.option-card[data-stream]').forEach(b => b.classList.remove('selected'));

        // Show board section
        showSection('board-section');

        // Hide stream section (reset)
        hideSection('stream-section');

        checkReady();
    }

    function selectBoard(el) {
        document.querySelectorAll('.option-card[data-board]').forEach(b => b.classList.remove('selected'));
        el.classList.add('selected');

        selectedBoard = el.dataset.board;
        document.getElementById('board_input').value = selectedBoard;

        // Show stream only for class 11 & 12
        if (selectedClass === '11' || selectedClass === '12') {
            showSection('stream-section');
        } else {
            hideSection('stream-section');
            selectedStream = null;
            document.getElementById('stream_input').value = '';
        }

        checkReady();
    }

    function selectStream(el) {
        document.querySelectorAll('.option-card[data-stream]').forEach(b => b.classList.remove('selected'));
        el.classList.add('selected');

        selectedStream = el.dataset.stream;
        document.getElementById('stream_input').value = selectedStream;

        checkReady();
    }

    function showSection(id) {
        const el = document.getElementById(id);
        el.classList.remove('section-hidden');
        el.classList.add('section-visible');
        el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideSection(id) {
        const el = document.getElementById(id);
        el.classList.remove('section-visible');
        el.classList.add('section-hidden');
    }

    function checkReady() {
        const needsStream = (selectedClass === '11' || selectedClass === '12');
        const ready = selectedClass && selectedBoard && (!needsStream || selectedStream);
        document.getElementById('submit-btn').disabled = !ready;
    }

    // Restore old values on validation error
    @if(old('class_level'))
        const oldClass = document.querySelector('[data-class="{{ old('class_level') }}"]');
        if (oldClass) selectClass(oldClass);
    @endif
    @if(old('board'))
        const oldBoard = document.querySelector('[data-board="{{ old('board') }}"]');
        if (oldBoard) selectBoard(oldBoard);
    @endif
    @if(old('stream'))
        const oldStream = document.querySelector('[data-stream="{{ old('stream') }}"]');
        if (oldStream) selectStream(oldStream);
    @endif
</script>
</body>
</html>
