@props(['model' => false, 'width' => 'w-3/4 md:w-1/2 2xl:w-1/3', 'actions' => null])

<div
    x-data="{ open: @entangle($model) }"
    x-show="open"
    x-cloak
    class="w-full h-screen bg-black bg-opacity-40 fixed top-0 left-0 py-8 flex items-center justify-center z-50"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div
        @click.away="open = false"
        class="relative {{ $width }} max-h-full bg-white rounded-md overflow-y-auto"
    >
        <button
            @click="open = false"
            type="button"
            class="absolute top-2 right-2.5"
            title="{{ __('Close') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700 hover:text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="w-full mt-10">
            <div class="px-6 pb-6 py-4">
                {{ $slot }} 
            </div>

            @if ($actions)
                <div class="p-4 bg-gray-100 flex items-center justify-end space-x-4">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
</div>
