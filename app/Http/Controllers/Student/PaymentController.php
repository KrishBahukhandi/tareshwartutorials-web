<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function verify(Request $request, Batch $batch)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        // Verify signature manually without SDK
        $secret = config('services.razorpay.secret');
        $signature = hash_hmac('sha256', $attributes['razorpay_order_id'] . '|' . $attributes['razorpay_payment_id'], $secret);

        if (!hash_equals($signature, $attributes['razorpay_signature'])) {
            Log::error('Razorpay signature mismatch', $attributes);
            return redirect()->route('checkout.show', $batch)
                ->with('error', 'Payment verification failed. Please try again or contact support.');
        }

        try {
            DB::transaction(function () use ($batch, $attributes) {
                // Create Payment record
                Payment::create([
                    'user_id' => auth()->id(),
                    'batch_id' => $batch->id,
                    'razorpay_order_id' => $attributes['razorpay_order_id'],
                    'razorpay_payment_id' => $attributes['razorpay_payment_id'],
                    'amount' => $batch->price,
                    'status' => 'successful',
                ]);

                // Create Enrollment
                $lockedBatch = Batch::whereKey($batch->id)->lockForUpdate()->firstOrFail();

                if (!$lockedBatch->canAcceptEnrollment()) {
                    throw new \DomainException('This batch is no longer accepting enrollments.');
                }

                // If user is already enrolled (e.g., failed past payment that created a pending enrollment), we update it.
                // But currently we don't have pending enrollments, so we just create.
                Enrollment::firstOrCreate([
                    'student_id' => auth()->id(),
                    'batch_id' => $lockedBatch->id,
                ], [
                    'enrollment_date' => now(),
                    'status' => 'active',
                    'progress_percentage' => 0,
                ]);
            });

            return redirect()->route('student.dashboard')
                ->with('success', 'Payment successful! You are now enrolled in the batch.');
                
        } catch (\Exception $e) {
            Log::error('Payment processing failed', ['error' => $e->getMessage(), 'attributes' => $attributes]);
            return redirect()->route('checkout.show', $batch)
                ->with('error', 'Payment successful, but enrollment failed. Please contact support.');
        }
    }
}
