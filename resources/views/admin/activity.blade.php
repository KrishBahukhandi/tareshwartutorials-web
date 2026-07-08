@extends('layouts.admin')

@section('title', 'Activity Log')

@section('content')
<div class="p-6">

    <div class="flex items-start justify-between mb-6">
        <div>
            <nav class="text-xs text-gray-400 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-600">Dashboard</a>
                <span class="mx-1">›</span>
                <span class="text-gray-600">Activity Log</span>
            </nav>
            <h1 class="text-2xl font-bold text-gray-900">Activity Log</h1>
            <p class="text-sm text-gray-500 mt-0.5">Full history of school operations and admin actions.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="space-y-4">
            @forelse($activities as $activity)
                @include('admin._activity_item', ['activity' => $activity])
            @empty
                <p class="text-xs text-gray-400 text-center py-4">No activity recorded yet.</p>
            @endforelse
        </div>

        @if($activities->hasPages())
            <div class="mt-5 pt-5 border-t border-gray-100">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
