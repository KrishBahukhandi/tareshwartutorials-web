<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $enrollments = Enrollment::query()
            ->with(['batch.teachers'])
            ->where('student_id', auth()->id())
            ->whereIn('status', ['active', 'completed', 'suspended'])
            ->orderByDesc('enrollment_date')
            ->get();

        $stats = [
            'total_enrolled' => $enrollments->count(),
            'active_batches' => $enrollments->where('status', 'active')->count(),
            'average_progress' => (int) round($enrollments->avg('progress_percentage') ?? 0),
        ];

        return view('student.dashboard', compact('enrollments', 'stats'));
    }
}
