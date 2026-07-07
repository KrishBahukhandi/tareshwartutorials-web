<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        $batches = $user->batches()->withCount('enrollments')->get();
        
        $stats = [
            'total_batches' => $batches->count(),
            'total_students' => $batches->sum('enrollments_count'),
            'total_lectures' => \App\Models\Lecture::whereIn('batch_id', $batches->pluck('id'))->count(),
            'total_notes' => \App\Models\BatchNote::where('teacher_id', $user->id)->count(),
        ];

        // Let's get the 3 most recently created lectures across all their batches as "Recent Activity"
        $recentLectures = \App\Models\Lecture::whereIn('batch_id', $batches->pluck('id'))
            ->with('batch')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('teacher.dashboard', compact('batches', 'stats', 'recentLectures'));
    }
}
