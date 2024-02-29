import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

window.FilePond = FilePond;

document.addEventListener('alpine:init', () => {
    window.Alpine.directive('tc-confirm', (element, value) => {
        element.onclick = (evt) => {        
            Livewire.dispatch('tc-confirmation', { data: value.expression })
        }
    })
})
