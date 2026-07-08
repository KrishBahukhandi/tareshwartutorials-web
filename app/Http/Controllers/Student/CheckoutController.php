<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show(Batch $batch): View
    {
        // Ensure user can enroll
        Gate::authorize('create', [Enrollment::class, $batch]);

        if (! $batch->canAcceptEnrollment()) {
            abort(403, 'This batch is no longer accepting enrollments.');
        }

        $razorpayOrderId = null;
        
        if ($batch->price > 0) {
            $response = Http::withBasicAuth(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            )->post('https://api.razorpay.com/v1/orders', [
                'amount'   => (int) ($batch->price * 100), // Amount in paise
                'currency' => 'INR',
                'receipt'  => 'receipt_' . Str::random(10),
            ]);

            if ($response->successful()) {
                $razorpayOrderId = $response->json('id');
            } else {
                // In a real application, handle this error properly
                abort(500, 'Unable to initialize payment gateway.');
            }
        }

        return view('student.checkout.show', compact('batch', 'razorpayOrderId'));
    }
}
