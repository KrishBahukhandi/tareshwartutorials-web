<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreEnrollmentRequest;
use App\Models\ActivityLog;
use App\Models\Batch;
use App\Models\Enrollment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index(): View
    {
        $enrollments = Enrollment::query()
            ->with(['batch.teachers'])
            ->where('student_id', auth()->id())
            ->where('status', 'active')
            ->orderByDesc('enrollment_date')
            ->paginate(15);

        return view('student.enrollments.index', compact('enrollments'));
    }

    public function store(StoreEnrollmentRequest $request, Batch $batch): RedirectResponse
    {
        Gate::authorize('create', [Enrollment::class, $batch]);

        try {
            DB::transaction(function () use ($batch): void {
                $lockedBatch = Batch::whereKey($batch->id)->lockForUpdate()->firstOrFail();

                if (! $lockedBatch->canAcceptEnrollment()) {
                    throw new \DomainException('This batch is no longer accepting enrollments.');
                }

                Enrollment::create([
                    'student_id' => auth()->id(),
                    'batch_id' => $lockedBatch->id,
                    'enrollment_date' => now(),
                    'status' => 'active',
                    'progress_percentage' => 0,
                ]);

                ActivityLog::create([
                    'description' => '<strong>'.e(auth()->user()->name).'</strong> enrolled in <strong>'.e($lockedBatch->name).'</strong>.',
                    'icon' => 'user-plus',
                    'color' => 'green',
                ]);
            });
        } catch (\DomainException $exception) {
            return back()->withErrors(['batch' => $exception->getMessage()]);
        } catch (QueryException) {
            return back()->withErrors(['batch' => 'You are already enrolled in this batch.']);
        }

        return redirect()
            ->route('student.dashboard')
            ->with('success', "You're enrolled in {$batch->name}.");
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Batch $batch): RedirectResponse
    {
        $enrollment = Enrollment::query()
            ->where('student_id', auth()->id())
            ->where('batch_id', $batch->id)
            ->first();

        if (! $enrollment) {
            return back()->withErrors(['batch' => 'You are not enrolled in this batch.']);
        }

        Gate::authorize('delete', $enrollment);

        $enrollment->update(['status' => 'dropped']);

        ActivityLog::create([
            'description' => '<strong>'.e(auth()->user()->name).'</strong> dropped <strong>'.e($batch->name).'</strong>.',
            'icon' => 'alert',
            'color' => 'orange',
        ]);

        return redirect()
            ->route('student.dashboard')
            ->with('success', "You've dropped {$batch->name}.");
    }
}
