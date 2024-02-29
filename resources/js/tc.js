document.addEventListener('alpine:init', () => {
    window.Alpine.directive('tc-confirm', (element, value) => {
        element.onclick = (evt) => {        
            Livewire.dispatch('tc-confirmation', { data: value.expression });
        };
    });
})
