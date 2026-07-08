@extends('layouts.public')

@section('title', 'About Us | Tareshwar Tutorials')
@section('description', 'Learn about Tareshwar Tutorials — a two-teacher coaching centre in Sector 19, Panchkula, run since 2018 with small batches and personal attention for Classes I–XII.')

@section('content')

{{-- ── Hero Section ── --}}
<section class="relative bg-primary pt-xxl pb-xl overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>
    <div class="max-w-container-max mx-auto px-gutter relative z-10 text-center">
        <span class="inline-block bg-secondary-fixed text-primary text-xs font-bold uppercase tracking-wider px-md py-xs rounded-full mb-md">
            Now enrolling for Session 2026–27
        </span>
        <h1 class="font-headline-xl text-headline-xl text-on-primary mb-md">Small batches, big breakthroughs.</h1>
        <p class="font-body-lg text-body-lg text-secondary-fixed">Learning that feels like home.</p>
    </div>
</section>

{{-- ── Stats Band ── --}}
<section class="bg-primary-container py-xl border-b border-outline-variant">
    <div class="max-w-container-max mx-auto px-gutter grid grid-cols-3 gap-lg text-center">
        <div>
            <p class="font-headline-lg text-headline-lg text-on-primary font-extrabold">320+</p>
            <p class="text-secondary-fixed text-sm mt-1">Students taught</p>
        </div>
        <div>
            <p class="font-headline-lg text-headline-lg text-on-primary font-extrabold">96%</p>
            <p class="text-secondary-fixed text-sm mt-1">Class X &amp; XII pass rate</p>
        </div>
        <div>
            <p class="font-headline-lg text-headline-lg text-on-primary font-extrabold">8 yrs</p>
            <p class="text-secondary-fixed text-sm mt-1">In the neighbourhood</p>
        </div>
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

        {{-- Results Section --}}
        <div class="mt-xxl border-t border-outline-variant pt-xxl">
            <div class="text-center mb-xl">
                <span class="text-secondary font-bold tracking-wider uppercase text-sm mb-sm block">Our Students</span>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Results that speak for themselves.</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto">
                    Class X · CBSE Board 2025–26. We're proud of every student who walked through the door and put in the work.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 gap-lg max-w-2xl mx-auto">
                <div class="bg-white border border-outline-variant rounded-2xl p-xl text-center shadow-sm">
                    <p class="font-headline-xl text-headline-xl text-primary font-extrabold">92%</p>
                    <p class="text-on-surface-variant text-sm mt-sm">Class X · CBSE 2026</p>
                    <span class="inline-block mt-sm text-xs font-bold uppercase tracking-wider text-secondary">🏆 Top Scorer</span>
                </div>
                <div class="bg-white border border-outline-variant rounded-2xl p-xl text-center shadow-sm">
                    <p class="font-headline-xl text-headline-xl text-primary font-extrabold">83%</p>
                    <p class="text-on-surface-variant text-sm mt-sm">Class X · CBSE 2026</p>
                    <span class="inline-block mt-sm text-xs font-bold uppercase tracking-wider text-secondary">⭐ Distinction</span>
                </div>
            </div>
        </div>

        {{-- What We Teach Section --}}
        <div class="mt-xxl border-t border-outline-variant pt-xxl">
            <div class="text-center mb-xl">
                <span class="text-secondary font-bold tracking-wider uppercase text-sm mb-sm block">What We Teach</span>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-md">Tuition built around how your child actually learns.</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto">
                    Four grade-banded programs, every batch kept small so questions are never a luxury.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-lg">
                <div class="bg-white border border-outline-variant rounded-xl p-lg">
                    <h3 class="font-bold text-primary mb-1">Foundation</h3>
                    <p class="text-xs text-on-surface-variant mb-sm">Classes I – V</p>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Reading fluency, mental maths, EVS — playful, story-led, and never rushed.</p>
                </div>
                <div class="bg-white border border-outline-variant rounded-xl p-lg">
                    <h3 class="font-bold text-primary mb-1">Middle School</h3>
                    <p class="text-xs text-on-surface-variant mb-sm">Classes VI – VIII</p>
                    <p class="text-sm text-on-surface-variant leading-relaxed">The years where habits stick — a study system that carries into board years.</p>
                </div>
                <div class="bg-white border border-outline-variant rounded-xl p-lg">
                    <h3 class="font-bold text-primary mb-1">Board Year</h3>
                    <p class="text-xs text-on-surface-variant mb-sm">Classes IX – X</p>
                    <p class="text-sm text-on-surface-variant leading-relaxed">CBSE-aligned with weekly chapter tests and dedicated pre-board revision.</p>
                </div>
                <div class="bg-white border border-outline-variant rounded-xl p-lg">
                    <h3 class="font-bold text-primary mb-1">Senior Science</h3>
                    <p class="text-xs text-on-surface-variant mb-sm">Classes XI – XII</p>
                    <p class="text-sm text-on-surface-variant leading-relaxed">Biology &amp; Chemistry by subject specialists, with NEET-style problem sets.</p>
                </div>
            </div>
            <div class="text-center mt-xl">
                <a href="{{ route('batches.index') }}" class="inline-flex items-center gap-sm bg-primary text-white px-lg py-md rounded-lg font-bold hover:bg-secondary transition-colors">
                    Explore Batches
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </a>
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
                    <div class="bg-surface-container-low p-md rounded-xl border border-outline-variant space-y-md">
                        <div class="flex items-start gap-md">
                            <span class="material-symbols-outlined text-secondary text-[24px]">location_on</span>
                            <div>
                                <h4 class="font-bold text-primary mb-1">Tareshwar Tutorials</h4>
                                <p class="text-on-surface-variant text-sm">CN 0018, Basement Sector 19<br>Panchkula, Haryana 134113</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-md">
                            <span class="material-symbols-outlined text-secondary text-[24px]">schedule</span>
                            <div>
                                <h4 class="font-bold text-primary mb-1">Office Hours</h4>
                                <p class="text-on-surface-variant text-sm">Mon – Sat · 3:30 PM – 9:30 PM<br>Sundays off</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-md">
                            <span class="material-symbols-outlined text-secondary text-[24px]">call</span>
                            <div>
                                <h4 class="font-bold text-primary mb-1">Call or WhatsApp</h4>
                                <p class="text-on-surface-variant text-sm">
                                    <a href="tel:+916280554348" class="hover:underline">+91 62805 54348</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-md">
                    <div class="space-y-md">
                        <div class="rounded-xl overflow-hidden shadow-sm h-48">
                            <img src="{{ asset('images/centre-classroom-1.jpeg') }}" alt="Tareshwar Tutorials classroom" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-sm h-32">
                            <img src="{{ asset('images/centre-classroom-2.jpeg') }}" alt="Classroom seating and whiteboard" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-md mt-lg">
                        <div class="rounded-xl overflow-hidden shadow-sm h-32">
                            <img src="{{ asset('images/centre-classroom-3.jpeg') }}" alt="Classroom with podium" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-sm h-48 bg-surface-container-low flex items-center justify-center">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="Tareshwar Tutorials logo" class="w-2/3 h-2/3 object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
