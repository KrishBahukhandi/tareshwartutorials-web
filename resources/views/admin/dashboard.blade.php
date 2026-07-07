@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('search_placeholder', 'Search student records, batches...')

@section('content')
<div class="p-6">

    {{-- Page Header --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-sm text-gray-500 mt-0.5">Summary of school operations for Spring Term 2024</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.teachers.create') }}"
               id="add-teacher-btn"
               class="flex items-center gap-2 px-4 py-2.5 border-2 border-[#1e3a5f] text-[#1e3a5f] rounded-lg text-sm font-semibold hover:bg-[#1e3a5f] hover:text-white transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Add Teacher
            </a>
            <a href="{{ route('admin.batches.index') }}?openModal=1"
               id="create-batch-btn"
               class="flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] text-white rounded-lg text-sm font-semibold hover:bg-[#162d4a] transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Batch
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-4 gap-4 mb-6">

        {{-- Total Students --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">+12%</span>
            </div>
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest mb-1">Total Students</p>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_students']) }}</p>
        </div>

        {{-- Total Teachers --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">+3%</span>
            </div>
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest mb-1">Total Teachers</p>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_teachers']) }}</p>
        </div>

        {{-- Active Batches --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">Active</span>
            </div>
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest mb-1">Active Batches</p>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['active_batches']) }}</p>
        </div>

        {{-- Avg Attendance --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">+0.5%</span>
            </div>
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-widest mb-1">Avg. Attendance</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['avg_attendance'] }}%</p>
        </div>

    </div>

    {{-- Charts + Activity --}}
    <div class="grid grid-cols-3 gap-4">

        {{-- Enrollment Trends Chart --}}
        <div class="col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-start justify-between mb-5">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Enrollment Trends</h2>
                    <p class="text-xs text-gray-500 mt-0.5">New student registrations per month</p>
                </div>
                <select id="chart-period"
                        class="text-xs border border-gray-200 rounded-lg px-3 py-1.5 text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]/20 bg-white">
                    <option>Last 6 Months</option>
                    <option>Last 3 Months</option>
                    <option>This Year</option>
                </select>
            </div>
            <div class="relative h-52">
                <canvas id="enrollmentChart"></canvas>
            </div>
            <div class="flex items-center gap-6 mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#1e3a5f] inline-block"></span>
                    <span class="text-xs text-gray-600">Regular Admissions</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-blue-400 inline-block"></span>
                    <span class="text-xs text-gray-600">Lateral Entry</span>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-bold text-gray-900">Recent Activity</h2>
                <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">View All</a>
            </div>

            <div class="space-y-4">
                @forelse($recentActivity as $activity)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-0.5
                                    {{ match($activity->color) {
                                        'green'  => 'bg-emerald-100',
                                        'red'    => 'bg-red-100',
                                        'purple' => 'bg-purple-100',
                                        default  => 'bg-blue-100'
                                    } }}">
                            <svg class="w-4 h-4 {{ match($activity->color) {
                                        'green'  => 'text-emerald-600',
                                        'red'    => 'text-red-600',
                                        'purple' => 'text-purple-600',
                                        default  => 'text-blue-600'
                                    } }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($activity->icon === 'user-plus')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                @elseif($activity->icon === 'batch')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"/>
                                @elseif($activity->icon === 'alert')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                @endif
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-gray-700 leading-relaxed">{!! $activity->description !!}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-4">No recent activity.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN'],
            datasets: [
                {
                    label: 'Regular Admissions',
                    data: [320, 410, 380, 520, 480, 610],
                    borderColor: '#1e3a5f',
                    backgroundColor: 'rgba(30,58,95,0.07)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#1e3a5f',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                },
                {
                    label: 'Lateral Entry',
                    data: [80, 110, 95, 130, 120, 160],
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96,165,250,0.07)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#60a5fa',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e3a5f',
                    titleColor: '#fff',
                    bodyColor: '#93c5fd',
                    padding: 10,
                    cornerRadius: 8,
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#9ca3af', font: { size: 11 } }
                },
                y: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    border: { display: false },
                    ticks: { color: '#9ca3af', font: { size: 11 } }
                }
            }
        }
    });
</script>
@endpush
