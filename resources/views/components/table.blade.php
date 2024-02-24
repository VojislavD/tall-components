<div>
    <div class="flex justify-between">
        <div class="flex items-center space-x-3">
            @isset($search)
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute top-1/2 -translate-y-1/2 left-3 text-slate-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>                      
                    <input 
                        type="search"
                        wire:model.live.debounce.500ms="tcSearch"
                        class="w-80 rounded focus:outline-none focus:ring-0 border-slate-300 focus:border-primary pl-10 placeholder-slate-400 py-1.5" 
                        placeholder="{{ __('Search') }}"
                    />
                </div>
            @endisset

            @isset($filters)
                {{ $filters }}
            @endisset
        </div>

        <div class="flex items-center space-x-2">
            @isset($perPage)
                {{ $perPage }}
            @endisset
        </div>
    </div>

    <table class="w-full mt-4">
        @isset($heading)
            <thead>
                {{ $heading }}
            </thead>
        @endisset

        <tbody>
            {{ $slot }}
        </tbody>
    </table>

    <div class="mt-4">
        @isset($pagination)
            {{ $pagination }}
        @endif
    </div>
</div>
