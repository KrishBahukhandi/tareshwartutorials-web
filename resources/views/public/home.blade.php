@extends('layouts.public')

@section('title', 'Tareshwar Tutorials | Master Your Future with Academic Precision')
@section('description', 'Join live CBSE-aligned batches for Class 10 and Class 12 with expert teachers, or browse free NCERT notes and previous year question papers — no sign-up required.')

@section('content')

{{-- ── Hero Section ── --}}
<section class="relative overflow-hidden bg-white py-xxl lg:py-32">
    <div class="absolute inset-0 opacity-5 pointer-events-none transition-all duration-700 opacity-100 translate-y-0">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(#031635 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>
    <div class="max-w-container-max mx-auto px-gutter relative z-10 grid lg:grid-cols-2 gap-xl items-center transition-all duration-700 opacity-100 translate-y-0">
        <div class="space-y-lg text-center lg:text-left">
            <div class="inline-flex items-center gap-xs px-md py-xs bg-secondary-fixed text-on-secondary-fixed rounded-full font-label-sm">
                <span class="material-symbols-outlined text-[16px]">verified</span>
                Trusted by 1,000+ Offline Students in Panchkula
            </div>
            <h1 class="font-headline-xl text-headline-xl text-primary leading-tight">
                Master Your Future with <span class="text-secondary">Academic Precision</span>
            </h1>
                Join expert-led batches designed for dedicated learners. Our patient, concept-first approach ensures strong fundamentals and board exam readiness.
            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-md pt-md">
                <a href="{{ route('batches.index') }}" class="w-full sm:w-auto bg-primary text-on-primary px-xl py-md rounded-lg font-label-md transition-all hover:bg-primary-container shadow-lg flex items-center justify-center gap-sm">
                    Explore Batches
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="{{ route('batches.index') }}" class="w-full sm:w-auto border border-primary text-primary px-xl py-md rounded-lg font-label-md transition-all hover:bg-surface-container-low flex items-center justify-center gap-sm">
                    View Curriculum
                </a>
            </div>
        </div>
        <div class="relative group">
            <div class="absolute -inset-4 bg-primary/5 rounded-xl blur-2xl group-hover:bg-primary/10 transition-all duration-700"></div>
            <div class="relative rounded-xl overflow-hidden shadow-2xl bg-white border border-outline-variant">
                <img class="w-full h-auto object-cover"
                     src="https://lh3.googleusercontent.com/aida-public/AB6AXuCiEsJN39_aRc0-zRH0Pg-nm-KiSLHnZ2M9ICrF3mgOeu5MRvulM4V-L3DKp4Z5QwE9cQqMYL23YjFgRtX-9BYcCXkNqZeQsee7bpSUFnebxnBwuqOCHQ-ZERYiuuEsBeeplJDEfEHxY-1QONCW1RHVvxnSrCfPWOeEFWKgDb0F7tMUEBaAYAp8QwNCEgtfQN4MK5GmJBg2ibhd4xpBFRrUe8zMYQ2pHB-ujRkdCAxw7FDwYalJLKQX9MocrT3crq5_8Cjt4417ry8"
                     alt="Students collaborating in a university library">
                <div class="absolute bottom-md right-md glass-card p-md rounded-lg shadow-xl animate-bounce">
                    <div class="flex items-center gap-sm">
                        <div class="bg-on-tertiary-container/10 p-xs rounded-full">
                            <span class="material-symbols-outlined text-on-tertiary-container">school</span>
                        </div>
                        <div>
                            <p class="text-label-sm font-bold text-primary">320+ Students Taught</p>
                            <p class="text-xs text-on-surface-variant">8 years in Panchkula</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Stats Section ── --}}
<section class="bg-surface-container-low py-xl">
    <div class="max-w-container-max mx-auto px-gutter transition-all duration-700 opacity-100 translate-y-0">
        <div class="grid grid-cols-3 gap-lg text-center">
            <div>
                <p class="font-headline-lg text-headline-lg text-primary font-extrabold">320+</p>
                <p class="text-on-surface-variant text-sm mt-1">Students taught</p>
            </div>
            <div>
                <p class="font-headline-lg text-headline-lg text-primary font-extrabold">96%</p>
                <p class="text-on-surface-variant text-sm mt-1">Class X &amp; XII pass rate</p>
            </div>
            <div>
                <p class="font-headline-lg text-headline-lg text-primary font-extrabold">8 yrs</p>
                <p class="text-on-surface-variant text-sm mt-1">In the neighbourhood</p>
            </div>
        </div>
    </div>
</section>

{{-- ── How It Works Section ── --}}
<section class="py-xxl bg-white">
    <div class="max-w-container-max mx-auto px-gutter transition-all duration-700 opacity-100 translate-y-0">
        <div class="text-center max-w-2xl mx-auto mb-xxl">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-md">How Tareshwar Tutorials Works</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Three simple steps to transform your academic journey and achieve professional excellence.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-xl relative">
            {{-- Connector line --}}
            <div class="hidden md:block absolute top-12 left-[15%] right-[15%] h-0.5 border-t-2 border-dashed border-outline-variant z-0"></div>
            {{-- Step 1 --}}
            <div class="relative z-10 text-center space-y-md">
                <div class="w-24 h-24 bg-primary rounded-full mx-auto flex items-center justify-center text-on-primary shadow-xl ring-8 ring-background">
                    <span class="material-symbols-outlined text-[40px]">person_add</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary">Join</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Enroll in a specialized batch that aligns with your professional aspirations and current skill level.</p>
            </div>
            {{-- Step 2 --}}
            <div class="relative z-10 text-center space-y-md">
                <div class="w-24 h-24 bg-secondary-container rounded-full mx-auto flex items-center justify-center text-on-primary shadow-xl ring-8 ring-background">
                    <span class="material-symbols-outlined text-[40px]">auto_stories</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary">Learn</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Engage in interactive, expert-led sessions designed with pedagogical precision for maximum retention.</p>
            </div>
            {{-- Step 3 --}}
            <div class="relative z-10 text-center space-y-md">
                <div class="w-24 h-24 bg-on-tertiary-container rounded-full mx-auto flex items-center justify-center text-on-primary shadow-xl ring-8 ring-background">
                    <span class="material-symbols-outlined text-[40px]">workspace_premium</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary">Excel</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Practice with assignments, previous year papers, and personalised feedback so you walk into your board exams fully prepared.</p>
            </div>
        </div>
    </div>
</section>

{{-- ── Offline Centre Promotion Section ── --}}
<section class="py-xxl bg-primary-container text-white overflow-hidden">
    <div class="max-w-container-max mx-auto px-gutter transition-all duration-700 opacity-100 translate-y-0">
        <div class="grid lg:grid-cols-2 gap-xxl items-center">
            <div class="relative h-64 md:h-96 rounded-2xl overflow-hidden shadow-2xl border border-white/20">
                <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('images/centre-classroom-3.jpeg') }}" alt="Tareshwar Tutorials Offline Centre in Panchkula">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-md left-md right-md flex items-center gap-sm">
                    <span class="material-symbols-outlined text-white">location_on</span>
                    <span class="text-white font-bold tracking-wide">CN OO18, Sector 19, Panchkula</span>
                </div>
            </div>
            <div class="space-y-lg">
                <div class="inline-flex items-center gap-xs px-md py-xs bg-white/10 text-white rounded-full font-label-sm border border-white/20">
                    <span class="material-symbols-outlined text-[16px]">map</span>
                    Physical Classrooms Available
                </div>
                <h2 class="font-headline-lg text-headline-lg text-white leading-tight">Prefer learning in person?</h2>
                <p class="font-body-lg text-body-lg text-on-primary-container">
                    Experience our highly-rated offline batches at our Sector 19 facility. We keep our physical batch sizes intentionally small to provide the patient, one-on-one attention a busy school day rarely allows.
                </p>
                <div class="pt-md">
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-sm bg-white text-primary px-xl py-md rounded-lg font-bold transition-transform active:scale-95 shadow-xl hover:bg-surface-container">
                        Book a Centre Visit
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── PYQs Section ── --}}
<section id="pyqs" class="py-xxl bg-white">
    <div class="max-w-container-max mx-auto px-gutter transition-all duration-700 opacity-100 translate-y-0">
        <div class="text-center max-w-2xl mx-auto mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-sm">Previous Year Questions (PYQs)</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Practice with authentic past board exam papers to boost your confidence and exam readiness.</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-xl max-w-4xl mx-auto">
            {{-- Class 10th --}}
            <a href="{{ route('pyqs.index', ['class' => 10]) }}" class="group relative bg-surface-container-low border border-outline-variant rounded-2xl p-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                <div class="absolute -inset-4 bg-primary/5 rounded-xl blur-2xl group-hover:bg-primary/10 transition-all duration-700 opacity-0 group-hover:opacity-100"></div>
                <div class="w-20 h-20 bg-secondary-container rounded-full flex items-center justify-center text-secondary mb-md shadow-md z-10">
                    <span class="material-symbols-outlined text-[32px]">history_edu</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary mb-xs z-10">Class 10th Boards</h3>
                <p class="text-on-surface-variant z-10 mb-md">Science, Mathematics, Social Science, and English PYQs with solutions.</p>
                <div class="text-primary font-bold inline-flex items-center gap-xs mt-auto z-10 group-hover:translate-x-2 transition-transform">
                    Access Papers
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </div>
            </a>

            {{-- Class 12th --}}
            <a href="{{ route('pyqs.index', ['class' => 12]) }}" class="group relative bg-surface-container-low border border-outline-variant rounded-2xl p-xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                <div class="absolute -inset-4 bg-primary/5 rounded-xl blur-2xl group-hover:bg-primary/10 transition-all duration-700 opacity-0 group-hover:opacity-100"></div>
                <div class="w-20 h-20 bg-on-tertiary-container rounded-full flex items-center justify-center text-on-primary mb-md shadow-md z-10">
                    <span class="material-symbols-outlined text-[32px]">school</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-primary mb-xs z-10">Class 12th Boards</h3>
                <p class="text-on-surface-variant z-10 mb-md">Physics, Chemistry, Mathematics, and Biology PYQs with solutions.</p>
                <div class="text-primary font-bold inline-flex items-center gap-xs mt-auto z-10 group-hover:translate-x-2 transition-transform">
                    Access Papers
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </div>
            </a>
        </div>
    </div>
</section>
{{-- ── Featured Batches Section (Bento Grid) ── --}}
<section class="py-xxl bg-background">
    <div class="max-w-container-max mx-auto px-gutter transition-all duration-700 opacity-100 translate-y-0">
        <div class="flex flex-col md:flex-row justify-between items-end mb-xl gap-md">
            <div class="max-w-xl">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-sm">Featured Batches</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Curated programs designed for intensive learning and industry-ready skills.</p>
            </div>
            <a href="{{ route('batches.index') }}" class="text-primary font-bold flex items-center gap-xs hover:underline decoration-2 underline-offset-4">
                View All Batches
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-lg">
            @if(isset($featuredBatches[0]))
            {{-- Main Featured Batch --}}
            <div class="md:col-span-8 group relative rounded-xl overflow-hidden bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-outline-variant">
                <div class="grid md:grid-cols-2 h-full">
                    <div class="relative h-64 md:h-full">
                        <img class="absolute inset-0 w-full h-full object-cover"
                             src="{{ asset('images/featured_science.png') }}"
                             alt="{{ $featuredBatches[0]->name }}">
                        <div class="absolute top-md left-md bg-on-tertiary-container text-white px-md py-xs rounded-full text-xs font-bold uppercase tracking-wider">Featured</div>
                    </div>
                    <div class="p-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-xs text-secondary font-label-sm mb-xs">
                                <span class="material-symbols-outlined text-sm">school</span>
                                {{ $featuredBatches[0]->grade }}
                            </div>
                            <h4 class="font-headline-md text-headline-md text-primary mb-md">{{ $featuredBatches[0]->name }}</h4>
                            <p class="text-on-surface-variant mb-xl line-clamp-3">Master concepts in {{ implode(', ', $featuredBatches[0]->subjects->pluck('name')->toArray()) }} with rigorous problem-solving sessions and 1:1 mentorship from experienced faculty.</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-bold text-xl">{{ $featuredBatches[0]->student_limit }} Seats</span>
                            <a href="{{ route('batches.show', $featuredBatches[0]) }}" class="bg-primary text-on-primary px-lg py-sm rounded-lg font-label-md transition-transform active:scale-95">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(isset($featuredBatches[1]))
            {{-- Secondary Batch 1 --}}
            <div class="md:col-span-4 group relative rounded-xl overflow-hidden bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-outline-variant flex flex-col">
                <div class="relative h-48">
                    <img class="w-full h-full object-cover"
                         src="{{ asset('images/featured_pcb.png') }}"
                         alt="{{ $featuredBatches[1]->name }}">
                </div>
                <div class="p-lg flex-1 flex flex-col justify-between">
                    <div>
                        <h4 class="font-headline-md text-headline-md text-primary mb-sm leading-tight">{{ $featuredBatches[1]->name }}</h4>
                        <p class="text-on-surface-variant text-sm mb-md">{{ implode(', ', $featuredBatches[1]->subjects->pluck('name')->toArray()) }} for {{ $featuredBatches[1]->grade }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-primary font-bold">{{ $featuredBatches[1]->student_limit }} Seats</span>
                        <a href="{{ route('batches.show', $featuredBatches[1]) }}" class="text-primary font-bold hover:underline">Details</a>
                    </div>
                </div>
            </div>
            @endif

            @if(isset($featuredBatches[2]))
            {{-- Secondary Batch 2 --}}
            <div class="md:col-span-4 group relative rounded-xl overflow-hidden bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-outline-variant flex flex-col">
                <div class="relative h-48">
                    <img class="w-full h-full object-cover"
                         src="{{ asset('images/featured_math.png') }}"
                         alt="{{ $featuredBatches[2]->name }}">
                </div>
                <div class="p-lg flex-1 flex flex-col justify-between">
                    <div>
                        <h4 class="font-headline-md text-headline-md text-primary mb-sm leading-tight">{{ $featuredBatches[2]->name }}</h4>
                        <p class="text-on-surface-variant text-sm mb-md">{{ implode(', ', $featuredBatches[2]->subjects->pluck('name')->toArray()) }} for {{ $featuredBatches[2]->grade }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-primary font-bold">{{ $featuredBatches[2]->student_limit }} Seats</span>
                        <a href="{{ route('batches.show', $featuredBatches[2]) }}" class="text-primary font-bold hover:underline">Details</a>
                    </div>
                </div>
            </div>
            @endif

            {{-- CTA Block --}}
            <div class="md:col-span-8 bg-primary-container rounded-xl p-xl flex flex-col md:flex-row items-center justify-between gap-xl">
                <div class="text-on-primary text-center md:text-left">
                    <h4 class="text-2xl font-bold mb-xs text-white">Don't see what you're looking for?</h4>
                    <p class="text-on-primary-container">We launch new specialized batches every month. Get notified.</p>
                </div>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex w-full md:w-auto bg-white/10 rounded-lg p-xs border border-white/20">
                    @csrf
                    <input name="email" required class="bg-transparent border-none text-white focus:ring-0 w-full px-md placeholder:text-on-primary-container" placeholder="Enter your email" type="email">
                    <button type="submit" class="bg-on-primary text-primary px-lg py-sm rounded font-bold whitespace-nowrap">Notify Me</button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ── Social Proof / Testimonial Section ── --}}
<section class="py-xxl bg-white overflow-hidden">
    <div class="max-w-container-max mx-auto px-gutter transition-all duration-700 opacity-100 translate-y-0">
        <div class="grid lg:grid-cols-2 gap-xxl items-center">
            <div class="space-y-lg">
                <h2 class="font-headline-lg text-headline-lg text-primary">The Tareshwar Tutorials Difference</h2>
                <div class="space-y-md">
                    <div class="flex gap-md p-md rounded-lg hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                        <span class="material-symbols-outlined text-secondary text-3xl">psychology</span>
                        <div>
                            <h4 class="font-bold text-primary">Personalized Learning Paths</h4>
                            <p class="text-on-surface-variant text-sm">Adaptive curricula that evolve based on your individual performance and focus areas.</p>
                        </div>
                    </div>
                    <div class="flex gap-md p-md rounded-lg hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                        <span class="material-symbols-outlined text-secondary text-3xl">groups</span>
                        <div>
                            <h4 class="font-bold text-primary">Exclusive Peer Communities</h4>
                            <p class="text-on-surface-variant text-sm">Join a network of high-achievers and industry mentors for lifelong collaboration.</p>
                        </div>
                    </div>
                    <div class="flex gap-md p-md rounded-lg hover:bg-surface-container-low transition-colors border border-transparent hover:border-outline-variant">
                        <span class="material-symbols-outlined text-secondary text-3xl">shield</span>
                        <div>
                            <h4 class="font-bold text-primary">Concept Mastery</h4>
                            <p class="text-on-surface-variant text-sm">We focus on strong fundamentals so you understand the 'why' behind every topic, not just the 'how'.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -top-12 -left-12 text-[120px] text-primary/5 font-serif select-none">"</div>
                <div class="bg-white p-xl rounded-xl shadow-2xl border border-outline-variant relative z-10">
                    <div class="flex gap-xs text-tertiary mb-md">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-lg italic text-primary leading-relaxed mb-xl">
                        "Devyani ma'am's way of teaching Science made all the difference for my boards. It's not just about memorising; she ensures you actually understand the concepts. The small batch size meant I could always clear my doubts."
                    </p>
                    <div class="flex items-center gap-md">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container-high flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-surface-variant">person</span>
                        </div>
                        <div>
                            <p class="font-bold text-primary">Rohan M.</p>
                            <p class="text-sm text-on-surface-variant">Class 10 Student, CBSE</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 w-full h-full border-2 border-primary/10 rounded-xl -z-10"></div>
            </div>
        </div>
    </div>
</section>

{{-- ── Final CTA Section ── --}}
<section class="py-xxl bg-primary text-on-primary">
    <div class="max-w-container-max mx-auto px-gutter text-center space-y-lg transition-all duration-700 opacity-100 translate-y-0">
        <h2 class="font-headline-lg text-headline-lg">Ready to Elevate Your Academic Standing?</h2>
        <p class="text-on-primary-container max-w-xl mx-auto">Limited seats available for the upcoming Winter Batches. Secure your spot and join the ranks of high-performance learners.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-md">
            <a href="{{ route('batches.index') }}" class="bg-on-primary text-primary px-xl py-md rounded-lg font-bold transition-transform active:scale-95 shadow-xl">Join the Next Batch</a>
            <a href="{{ route('contact') }}" class="border border-on-primary text-on-primary px-xl py-md rounded-lg font-bold hover:bg-white/10">Schedule a Call</a>
        </div>
    </div>
</section>

@endsection
