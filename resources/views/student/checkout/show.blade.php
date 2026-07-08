@extends('layouts.student')

@section('title', 'Checkout | ' . $batch->name)

@section('content')
<div class="max-w-4xl mx-auto py-xl">
    <div class="mb-lg">
        <a href="{{ route('batches.show', $batch) }}" class="text-sm text-secondary hover:underline flex items-center gap-1">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Back to Batch
        </a>
    </div>

    <h1 class="text-3xl font-extrabold text-primary mb-xl">Complete Enrollment</h1>

    <div class="grid lg:grid-cols-5 gap-xl">
        {{-- Order Summary --}}
        <div class="lg:col-span-3 space-y-md">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant p-lg">
                <h2 class="text-lg font-bold text-primary mb-md pb-sm border-b border-outline-variant">Order Summary</h2>
                
                <div class="flex gap-md mb-md">
                    <div class="w-24 h-24 bg-surface-container-low rounded-lg flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary text-4xl">local_library</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-primary text-lg">{{ $batch->name }}</h3>
                        <p class="text-sm text-on-surface-variant mb-1">Class {{ $batch->grade }}</p>
                        <div class="flex flex-wrap gap-xs">
                            @foreach($batch->subjects as $subject)
                                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-0.5 rounded">{{ $subject->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="space-y-sm text-sm border-t border-outline-variant pt-md">
                    @if($batch->price > 0)
                        <div class="flex justify-between font-bold text-primary text-lg pt-sm">
                            <span>Total Amount</span>
                            <span>₹ {{ number_format($batch->price, 2) }}</span>
                        </div>
                    @else
                        <div class="flex justify-between font-bold text-primary text-lg pt-sm">
                            <span>Total Amount</span>
                            <span class="text-emerald-600">Free</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="bg-blue-50 text-blue-800 p-4 rounded-xl flex gap-3 text-sm">
                <span class="material-symbols-outlined text-blue-600">info</span>
                <p>Enrolling in a batch gives you full access to live classes, chapter-wise assignments, and personalized teacher feedback.</p>
            </div>
        </div>

        {{-- Payment Methods --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant p-lg sticky top-24">
                <h2 class="text-lg font-bold text-primary mb-md pb-sm border-b border-outline-variant">Payment Method</h2>
                
                @if($batch->price > 0 && $razorpayOrderId)
                    <form action="{{ route('student.payment.verify', $batch) }}" method="POST">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                        
                        <label class="flex items-start gap-sm text-xs text-gray-500 mb-4">
                            <input type="checkbox" required checked class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary">
                            <span>I agree to the Terms of Service and Privacy Policy. I understand this will enroll me in {{ $batch->name }}.</span>
                        </label>
                        
                        <button type="button" id="rzp-button1" class="w-full bg-primary text-white px-lg py-md rounded-lg font-bold hover:bg-primary-container shadow-md flex justify-center items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                            Pay ₹{{ number_format($batch->price, 2) }} Securely
                        </button>
                    </form>
                    
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <script>
                    var options = {
                        "key": "{{ config('services.razorpay.key') }}",
                        "amount": "{{ $batch->price * 100 }}", 
                        "currency": "INR",
                        "name": "Tareshwar Tutorials",
                        "description": "Enrollment for {{ $batch->name }}",
                        "image": "{{ asset('images/favicon.png') }}",
                        "order_id": "{{ $razorpayOrderId }}",
                        "handler": function (response){
                            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                            document.getElementById('razorpay_signature').value = response.razorpay_signature;
                            document.forms[0].submit();
                        },
                        "prefill": {
                            "name": "{{ auth()->user()->name }}",
                            "email": "{{ auth()->user()->email }}"
                        },
                        "theme": {
                            "color": "#031635"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function (response){
                            alert(response.error.description);
                    });
                    document.getElementById('rzp-button1').onclick = function(e){
                        rzp1.open();
                        e.preventDefault();
                    }
                    </script>
                @else
                    <form method="POST" action="{{ route('student.enrollments.store', $batch) }}" class="space-y-lg">
                        @csrf
                        
                        <label class="flex items-start gap-sm text-xs text-gray-500 mt-4">
                            <input type="checkbox" required checked class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary">
                            <span>I agree to the Terms of Service and Privacy Policy. I understand this will enroll me in {{ $batch->name }}.</span>
                        </label>

                        <button type="submit" class="w-full bg-emerald-600 text-white px-lg py-md rounded-lg font-bold hover:bg-emerald-700 shadow-md flex justify-center items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-[20px]">school</span>
                            Enroll Now (Free)
                        </button>
                    </form>
                @endif
                
                <div class="text-center mt-4">
                    <span class="text-xs text-on-surface-variant flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">verified_user</span>
                        100% Secure & Encrypted
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
