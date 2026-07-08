<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'active_batches' => Batch::active()->count(),
            'active_enrollments' => Enrollment::where('status', 'active')->count(),
            'student_growth' => $this->growthPercentage(User::where('role', 'student'), 'created_at'),
            'teacher_growth' => $this->growthPercentage(User::where('role', 'teacher'), 'created_at'),
            'enrollment_growth' => $this->growthPercentage(Enrollment::where('status', 'active'), 'enrollment_date'),
        ];

        $period = $request->get('period', '6m');
        $months = match ($period) {
            '3m' => 3,
            '1y' => 12,
            default => 6,
        };

        $recentActivity = ActivityLog::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentActivity' => $recentActivity,
            'enrollmentTrend' => $this->monthlyEnrollmentTrend($months),
            'period' => $period,
        ]);
    }

    public function activity(): View
    {
        $activities = ActivityLog::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.activity', compact('activities'));
    }

    /**
     * Percentage change in $baseQuery's row count over the last month, or null
     * when there isn't a month of history to compare against.
     */
    private function growthPercentage(Builder $baseQuery, string $dateColumn): ?float
    {
        $now = (clone $baseQuery)->count();
        $monthAgo = (clone $baseQuery)->where($dateColumn, '<=', now()->subMonth())->count();

        if ($monthAgo === 0) {
            return null;
        }

        return round((($now - $monthAgo) / $monthAgo) * 100, 1);
    }

    /**
     * @return array{labels: array<int, string>, data: array<int, int>}
     */
    private function monthlyEnrollmentTrend(int $months): array
    {
        $labels = [];
        $data = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = $monthStart->copy()->endOfMonth();

            $labels[] = $monthStart->format($months > 6 ? 'M \'y' : 'M');
            $data[] = Enrollment::whereBetween('enrollment_date', [$monthStart, $monthEnd])->count();
        }

        return ['labels' => $labels, 'data' => $data];
    }
}
