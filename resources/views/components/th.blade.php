@props(['sortable' => null])

<th {{ $attributes->merge(['class' => 'py-3 px-2.5 text-left border-y border-primary font-bold uppercase']) }}>
    @if ($sortable)
        <button
            class="flex items-center space-x-2"
            type="button"
            wire:click="changeSorting('{{ $sortable }}')"
            wire:loading.attr="disabled"
        >
            <span>{{ $slot }}</span>
            @if ($sortable && $this->tcSortable !== $sortable)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                </svg>
            @elseif ($this->tcSortable && $this->tcSortable === $sortable)
                @if ($this->tcSortDirection === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="5" stroke="currentColor" class="w-3 h-3 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="5" stroke="currentColor" class="w-3 h-3 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                    </svg>
                @endif
            @endif
        </button>
    @else
        <span>
            {{ $slot }}
        </span>
    @endif
</th>
