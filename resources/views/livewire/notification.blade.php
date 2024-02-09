<div class="fixed top-8 left-1/2 -translate-x-1/2 z-50">
    <div
        x-data="{ show: @entangle('show').live, notificationTimeout: {{ $this->duration }} }"
        x-show="show"
        x-cloak
        x-effect="if (show) setTimeout(function() { show = false }, notificationTimeout)"
        x-transition:enter="transform ease-out duration-200 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="pointer-events-auto w-[80vw] md:w-[70vw] lg:w-[50vw] max-w-[700px] bg-green-100 overflow-hidden rounded-lg shadow-lg border border-green-200 z-50"
    >
        <div class="p-4 flex text-green-700">
            <div class="ml-3 flex-1">
                <p class="text-m font-medium">{{ session('notification') }}</p>
            </div>
            <button
                @click="show = false"
                type="button"
                class="hover:text-green-900"
                title="{{ __('Close') }}"
            >
                <svg
                    class="h-6 w-6"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <path
                        d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"
                    />
                </svg>
            </button>
        </div>
    </div>
</div>
