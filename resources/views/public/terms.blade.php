@extends('layouts.public')

@section('title', 'Terms of Service | Tareshwar Tutorials')

@section('content')

{{-- ── Hero Section ── --}}
<section class="relative bg-primary pt-xxl pb-xl overflow-hidden">
    <div class="max-w-container-max mx-auto px-gutter relative z-10 text-center">
        <h1 class="font-headline-xl text-headline-xl text-on-primary mb-md">Terms of Service</h1>
        <p class="font-body-lg text-body-lg text-secondary-fixed">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

{{-- ── Content ── --}}
<section class="py-xxl bg-background">
    <div class="max-w-3xl mx-auto px-gutter text-on-surface">
        
        <div class="prose prose-lg max-w-none">
            <p>Welcome to Tareshwar Tutorials. These terms and conditions outline the rules and regulations for the use of our website and services.</p>

            <h3>1. Acceptance of Terms</h3>
            <p>By accessing this website and enrolling in our coaching programs, we assume you accept these terms and conditions. Do not continue to use Tareshwar Tutorials if you do not agree to all of the terms and conditions stated on this page.</p>

            <h3>2. Enrollment and Fees</h3>
            <p>Enrollment in our batches is subject to availability and admission criteria. Fees must be paid according to the schedule provided at the time of admission. We reserve the right to suspend services for non-payment.</p>

            <h3>3. Attendance and Conduct</h3>
            <p>Students are expected to maintain regular attendance and conduct themselves respectfully. Tareshwar Tutorials reserves the right to dismiss any student whose behavior is disruptive to the learning environment.</p>

            <h3>4. Intellectual Property</h3>
            <p>Unless otherwise stated, Tareshwar Tutorials and/or its licensors own the intellectual property rights for all material provided during coaching (notes, worksheets, etc.). You may access this for your personal use subject to restrictions set in these terms and conditions.</p>
            <p>You must not:</p>
            <ul>
                <li>Republish material from Tareshwar Tutorials</li>
                <li>Sell, rent or sub-license material from Tareshwar Tutorials</li>
                <li>Reproduce, duplicate or copy material from Tareshwar Tutorials</li>
                <li>Redistribute content from Tareshwar Tutorials</li>
            </ul>

            <h3>5. Disclaimer</h3>
            <p>While we strive to provide the best education and support, we do not guarantee specific academic results or board scores. Success depends on the student's effort and dedication.</p>

            <h3>6. Modifications</h3>
            <p>We reserve the right to revise these terms at any time. By using this website and our services, you are expected to review these terms regularly.</p>
        </div>

    </div>
</section>

@endsection
