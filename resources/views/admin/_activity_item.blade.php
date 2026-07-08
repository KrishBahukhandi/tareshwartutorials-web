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
