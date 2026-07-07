<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(Batch $batch): View
    {
        // Ensure user can enroll
        Gate::authorize('create', [Enrollment::class, $batch]);

        if (! $batch->canAcceptEnrollment()) {
            abort(403, 'This batch is no longer accepting enrollments.');
        }

        return view('student.checkout.show', compact('batch'));
    }
}
