@extends('layouts.public')

@section('title', 'Contact Us | Tareshwar Tutorials')
@section('description', 'Get in touch with Tareshwar Tutorials — visit our centre in Panchkula, Haryana, or reach out by phone or email.')

@section('content')

{{-- ── Hero Section ── --}}
<section class="relative bg-primary pt-xxl pb-xl overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>
    <div class="max-w-container-max mx-auto px-gutter relative z-10 text-center">
        <h1 class="font-headline-xl text-headline-xl text-on-primary mb-md">Contact Us</h1>
        <p class="font-body-lg text-body-lg text-secondary-fixed">We'd love to hear from you. Get in touch with us.</p>
    </div>
</section>

{{-- ── Contact Content ── --}}
<section class="py-xxl bg-background">
    <div class="max-w-container-max mx-auto px-gutter grid lg:grid-cols-2 gap-xl items-start">
        
        {{-- Left Col: Visit Us Card --}}
        <div class="bg-white border border-outline-variant rounded-2xl p-xl shadow-sm text-on-surface">
            <h3 class="font-headline-lg text-headline-lg text-primary mb-xl">Visit our Centre</h3>
            
            <div class="space-y-lg mb-xl">
                {{-- Location --}}
                <div class="flex items-start gap-md">
                    <div class="w-12 h-12 rounded-full bg-surface-container-low border border-outline-variant flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary text-[24px]">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary mb-1 text-lg">The Centre</h4>
                        <p class="text-on-surface-variant leading-relaxed">CN OO18, Sector 19,<br>Panchkula, Haryana 134113</p>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="flex items-start gap-md">
                    <div class="w-12 h-12 rounded-full bg-surface-container-low border border-outline-variant flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary text-[24px]">call</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary mb-1 text-lg">Call or WhatsApp</h4>
                        <p class="text-on-surface-variant leading-relaxed">+91 62805 54348 (Divya)<br>+91 98765 43211 (Tejasvi)</p>
                    </div>
                </div>

                {{-- Hours --}}
                <div class="flex items-start gap-md">
                    <div class="w-12 h-12 rounded-full bg-surface-container-low border border-outline-variant flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary text-[24px]">schedule</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-primary mb-1 text-lg">Office hours</h4>
                        <p class="text-on-surface-variant leading-relaxed">Mon – Sat • 3:30 PM – 9:30 PM<br>Sundays off</p>
                    </div>
                </div>
            </div>

            {{-- Map Embed --}}
            <div class="rounded-xl overflow-hidden shadow-sm border border-outline-variant w-full h-[300px]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6863.571946463329!2d76.83520539999999!3d30.668154800000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390f94b19772333f%3A0x1f952a84b6417df0!2sTareshwar%20Tutorials!5e0!3m2!1sen!2sin!4v1783265314439!5m2!1sen!2sin" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
        </div>

        {{-- Right Col: Email & Other Links --}}
        <div class="space-y-xl">
            {{-- Email Card --}}
            <div class="bg-primary rounded-2xl p-xl text-on-primary shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative z-10 flex items-center gap-md mb-md">
                    <div class="w-12 h-12 rounded-full bg-secondary text-on-secondary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[24px]">mail</span>
                    </div>
                    <h3 class="font-headline-lg text-[24px] text-on-primary font-bold">Email Support</h3>
                </div>
                <p class="font-body-sm text-on-primary-container mb-lg relative z-10">
                    For general inquiries, technical issues, or payment-related concerns, our support team is ready to assist you.
                </p>
                <div class="relative z-10 bg-white/10 border border-white/20 rounded-xl p-md flex items-center justify-between">
                    <span class="font-bold text-lg">support@tareshwartutorials.com</span>
                    <a href="mailto:support@tareshwartutorials.com" class="px-md py-sm bg-white text-primary font-bold rounded-lg hover:bg-surface-container transition-colors text-sm">Send Email</a>
                </div>
            </div>

            {{-- Live Chat Card --}}
            <div class="bg-white border border-outline-variant rounded-2xl p-xl shadow-sm text-on-surface">
                <div class="flex items-center gap-md mb-md">
                    <div class="w-12 h-12 rounded-full bg-surface-container-low border border-outline-variant text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[24px]">chat</span>
                    </div>
                    <h3 class="font-headline-md text-primary font-bold">Live Chat</h3>
                </div>
                <p class="text-on-surface-variant mb-lg text-sm">
                    Connect directly with an expert advisor to get answers instantly. Available during regular office hours.
                </p>
                <button class="w-full py-md bg-secondary text-on-primary font-bold rounded-xl hover:bg-secondary-container transition-colors shadow-sm">
                    Start a Conversation
                </button>
            </div>
            
        </div>

    </div>
</section>

@endsection
