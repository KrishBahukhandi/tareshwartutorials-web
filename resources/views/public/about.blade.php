@extends('layouts.public')

@section('title', 'About Us | Tareshwar Tutorials')

@section('content')

{{-- ── Hero Section ── --}}
<section class="relative bg-primary pt-xxl pb-xl overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>
    <div class="max-w-container-max mx-auto px-gutter relative z-10 text-center">
        <h1 class="font-headline-xl text-headline-xl text-on-primary mb-md">Small batches, big breakthroughs.</h1>
        <p class="font-body-lg text-body-lg text-secondary-fixed">Learning that feels like home.</p>
    </div>
</section>

{{-- ── About Content ── --}}
<section class="py-xxl bg-background">
    <div class="max-w-container-max mx-auto px-gutter space-y-xl">
        
        {{-- Intro Section --}}
        <div class="max-w-3xl mx-auto text-center mb-xxl">
            <p class="text-on-surface-variant text-lg leading-relaxed">
                Tareshwar Tutorials is a neighbourhood coaching centre in Sector 19, Panchkula — run by two science teachers who still know every student by name. We focus on concepts, confidence, and the kind of patient attention a busy school day rarely allows.
            </p>
        </div>

        {{-- The Two Teachers Section Header --}}
        <div class="text-center mb-xl">
            <span class="text-secondary font-bold tracking-wider uppercase text-sm mb-sm block">The Two Teachers</span>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-md">You'll meet both of us. Often.</h2>
            <p class="text-on-surface-variant max-w-2xl mx-auto">
                No revolving door of part-timers. Every class at Tareshwar is taught by one of us — which is also why our batches stay small on purpose.
            </p>
        </div>

        {{-- Faculty Grid --}}
        <div class="grid lg:grid-cols-2 gap-xl">
            
            {{-- Teacher 1 --}}
            <div class="bg-white border border-outline-variant rounded-2xl p-xl shadow-sm text-on-surface flex flex-col md:flex-row gap-lg items-start">
                <div class="w-full md:w-1/3 aspect-[4/5] bg-surface-container-low rounded-xl overflow-hidden shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-primary-container to-secondary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[64px] text-primary">person</span>
                    </div>
                </div>
                <div class="space-y-md">
                    <div>
                        <h3 class="font-headline-md text-[24px] text-primary font-bold">Devyani Gautam</h3>
                        <div class="text-secondary font-medium">Founder · Science Lead</div>
                    </div>
                    <p class="text-on-surface-variant text-sm leading-relaxed">
                        Devyani started Tareshwar at the dining table in 2018 with four students from the neighbourhood. Eight years on, she still teaches every senior Biology class herself — patient with the slow questions, demanding on the basics.
                    </p>
                    <div class="flex flex-wrap gap-sm">
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">M.Sc. Biotechnology</span>
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">B.Sc. Biotechnology</span>
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">CBSE curriculum</span>
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">8 yrs teaching</span>
                    </div>
                    <blockquote class="italic text-primary border-l-4 border-primary pl-md py-sm mt-md bg-surface-container-low rounded-r-lg">
                        "Concepts first. Marks follow."
                    </blockquote>
                </div>
            </div>

            {{-- Teacher 2 --}}
            <div class="bg-white border border-outline-variant rounded-2xl p-xl shadow-sm text-on-surface flex flex-col md:flex-row gap-lg items-start">
                <div class="w-full md:w-1/3 aspect-[4/5] bg-surface-container-low rounded-xl overflow-hidden shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-secondary-container to-primary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[64px] text-secondary">person</span>
                    </div>
                </div>
                <div class="space-y-md">
                    <div>
                        <h3 class="font-headline-md text-[24px] text-primary font-bold">Tejasvi Phawa</h3>
                        <div class="text-secondary font-medium">Junior Wing · Chemistry & Maths</div>
                    </div>
                    <p class="text-on-surface-variant text-sm leading-relaxed">
                        Tejasvi handles the Class VI–X batches and the Saturday Spoken English club. Currently pursuing her B.Sc. in Industrial Microbiology — so the science is fresh, and the energy in the room shows it.
                    </p>
                    <div class="flex flex-wrap gap-sm">
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">B.Sc. Industrial Microbiology</span>
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">Chemistry & Maths</span>
                        <span class="px-sm py-xs bg-surface-container rounded-md text-xs font-medium text-on-surface">3 yrs teaching</span>
                    </div>
                    <blockquote class="italic text-primary border-l-4 border-primary pl-md py-sm mt-md bg-surface-container-low rounded-r-lg">
                        "The trick is to make them ask the question themselves."
                    </blockquote>
                </div>
            </div>

        </div>

        {{-- Our Centre Section --}}
        <div class="mt-xxl border-t border-outline-variant pt-xxl">
            <div class="grid lg:grid-cols-2 gap-xl items-center">
                <div class="space-y-lg">
                    <span class="text-secondary font-bold tracking-wider uppercase text-sm mb-sm block">Our Centre</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Learn where you belong.</h2>
                    <p class="text-on-surface-variant text-lg leading-relaxed">
                        Located conveniently in Sector 19, Panchkula, our centre is designed to be a focused, distraction-free environment where students can truly engage with their subjects. 
                    </p>
                    <div class="bg-surface-container-low p-md rounded-xl border border-outline-variant inline-block">
                        <div class="flex items-start gap-md">
                            <span class="material-symbols-outlined text-secondary text-[24px]">location_on</span>
                            <div>
                                <h4 class="font-bold text-primary mb-1">Tareshwar Tutorials</h4>
                                <p class="text-on-surface-variant text-sm">CN OO18, Sector 19<br>Panchkula, Haryana 134113</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-md">
                    <div class="space-y-md">
                        <div class="rounded-xl overflow-hidden shadow-sm h-48">
                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=800" alt="Classroom" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-sm h-32">
                            <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80&w=800" alt="Study materials" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-md mt-lg">
                        <div class="rounded-xl overflow-hidden shadow-sm h-32">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=800" alt="Student studying" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-sm h-48">
                            <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&q=80&w=800" alt="Discussion" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
