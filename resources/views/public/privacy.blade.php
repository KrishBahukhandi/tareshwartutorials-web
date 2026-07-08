@extends('layouts.public')

@section('title', 'Privacy Policy | Tareshwar Tutorials')
@section('description', 'Read how Tareshwar Tutorials collects, uses, and protects your personal information.')

@section('content')

{{-- ── Hero Section ── --}}
<section class="relative bg-primary pt-xxl pb-xl overflow-hidden">
    <div class="max-w-container-max mx-auto px-gutter relative z-10 text-center">
        <h1 class="font-headline-xl text-headline-xl text-on-primary mb-md">Privacy Policy</h1>
        <p class="font-body-lg text-body-lg text-secondary-fixed">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

{{-- ── Content ── --}}
<section class="py-xxl bg-background">
    <div class="max-w-3xl mx-auto px-gutter text-on-surface">
        
        <div class="prose prose-lg max-w-none">
            <p>At Tareshwar Tutorials, accessible from our premises and our website, one of our main priorities is the privacy of our visitors and students. This Privacy Policy document contains types of information that is collected and recorded by us and how we use it.</p>

            <h3>1. Information We Collect</h3>
            <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information. This may include:</p>
            <ul>
                <li>Student and Parent/Guardian names</li>
                <li>Contact information (email address, phone number, physical address)</li>
                <li>Academic records and schooling details</li>
            </ul>

            <h3>2. How We Use Your Information</h3>
            <p>We use the information we collect in various ways, including to:</p>
            <ul>
                <li>Provide, operate, and maintain our coaching services</li>
                <li>Improve, personalize, and expand our curriculum and offerings</li>
                <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the student's progress</li>
                <li>Process fee payments</li>
            </ul>

            <h3>3. Log Files</h3>
            <p>Tareshwar Tutorials follows a standard procedure of using log files on our digital platforms. These files log visitors when they visit websites. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable.</p>

            <h3>4. Security of Your Information</h3>
            <p>We take appropriate security measures to protect against unauthorized access to or unauthorized alteration, disclosure or destruction of data. However, remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable.</p>

            <h3>5. Contact Us</h3>
            <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us at support@tareshwartutorials.com.</p>
        </div>

    </div>
</section>

@endsection
