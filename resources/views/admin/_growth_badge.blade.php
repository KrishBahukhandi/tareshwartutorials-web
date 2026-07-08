@if($value !== null)
    <span class="text-xs font-semibold px-2 py-0.5 rounded-full
                 {{ $value >= 0 ? 'text-emerald-500 bg-emerald-50' : 'text-red-500 bg-red-50' }}">
        {{ $value >= 0 ? '+' : '' }}{{ $value }}%
    </span>
@endif
