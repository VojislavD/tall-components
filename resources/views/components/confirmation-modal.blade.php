<div
    x-data="{ open: @entangle('showTcConfirmationModal') }"
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
        class="relative w-3/4 md:w-1/2 max-w-[600px] max-h-full bg-white rounded-md overflow-y-auto"
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

        <div class="w-full my-6">
            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
              
            <div class="mt-2 text-center space-y-1 text-gray-700">
                @if (isset($this->tcConfirmationModalData['title']))
                    <p class="text-2xl font-bold">
                        {{ $this->tcConfirmationModalData['title'] }}
                    </p>
                @endif

                <p class="text-lg">
                    {{ $this->tcConfirmationModalData['message'] }} 
                </p>
            </div>

            <div class="flex items-center justify-center mt-6 space-x-4">
                <button 
                    @click="open = false"
                    class="bg-white hover:bg-gray-100 px-4 py-1 rounded border text-gray-800"
                >
                    {{ __('Cancel') }}
                </button>
                
                <button 
                    wire:click="{{ $this->tcConfirmationModalData['action'] }}"
                    @click="open = false"
                    class="bg-primary hover:bg-primary-dark text-white px-4 py-1 rounded border text-gray-800"
                >
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            window.Alpine.directive('confirm', (element, value) => {
                element.onclick = (evt) => {        
                    Livewire.dispatch('tc-confirmation', { data: value.expression });
                };
            });
        })
    </script>
</div>