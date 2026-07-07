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
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Course Fee</span>
                        <span>₹ 5,000</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant">
                        <span>GST (18%)</span>
                        <span>₹ 900</span>
                    </div>
                    <div class="flex justify-between font-bold text-primary text-lg pt-sm border-t border-outline-variant mt-sm">
                        <span>Total Amount</span>
                        <span>₹ 5,900</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 text-blue-800 p-4 rounded-xl flex gap-3 text-sm">
                <span class="material-symbols-outlined text-blue-600">info</span>
                <p>This is a mock payment gateway. Clicking "Pay Securely" will bypass actual payment collection and instantly enroll you in the batch.</p>
            </div>
        </div>

        {{-- Payment Methods --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-outline-variant p-lg sticky top-24">
                <h2 class="text-lg font-bold text-primary mb-md pb-sm border-b border-outline-variant">Payment Method</h2>
                
                <form method="POST" action="{{ route('student.enrollments.store', $batch) }}" class="space-y-lg">
                    @csrf
                    
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 border border-primary rounded-lg cursor-pointer bg-primary/5">
                            <input type="radio" name="payment_method" value="upi" checked class="text-primary focus:ring-primary h-4 w-4">
                            <div class="flex-1 flex justify-between items-center">
                                <span class="font-medium text-primary">UPI</span>
                                <span class="material-symbols-outlined text-secondary">qr_code_scanner</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center gap-3 p-3 border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-low transition">
                            <input type="radio" name="payment_method" value="card" class="text-primary focus:ring-primary h-4 w-4">
                            <div class="flex-1 flex justify-between items-center">
                                <span class="font-medium text-primary">Credit / Debit Card</span>
                                <span class="material-symbols-outlined text-secondary">credit_card</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center gap-3 p-3 border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-low transition">
                            <input type="radio" name="payment_method" value="netbanking" class="text-primary focus:ring-primary h-4 w-4">
                            <div class="flex-1 flex justify-between items-center">
                                <span class="font-medium text-primary">Net Banking</span>
                                <span class="material-symbols-outlined text-secondary">account_balance</span>
                            </div>
                        </label>
                    </div>
                    
                    <label class="flex items-start gap-sm text-xs text-gray-500 mt-4">
                        <input type="checkbox" required checked class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary">
                        <span>I agree to the Terms of Service and Privacy Policy. I understand this will enroll me in {{ $batch->name }}.</span>
                    </label>

                    <button type="submit" class="w-full bg-primary text-white px-lg py-md rounded-lg font-bold hover:bg-primary-container shadow-md flex justify-center items-center gap-2 transition-all">
                        <span class="material-symbols-outlined text-[20px]">lock</span>
                        Pay Securely (Mock)
                    </button>
                    
                    <div class="text-center mt-4">
                        <span class="text-xs text-on-surface-variant flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">verified_user</span>
                            100% Secure & Encrypted
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
