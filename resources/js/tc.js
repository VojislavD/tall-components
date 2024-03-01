import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

window.FilePond = FilePond;

FilePond.registerPlugin(FilePondPluginFileValidateSize);
FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginImagePreview);

document.addEventListener('alpine:init', () => {
    window.Alpine.directive('tc-confirm', (element, value) => {
        element.onclick = (evt) => {        
            Livewire.dispatch('tc-confirmation', { data: value.expression })
        }
    })
})
