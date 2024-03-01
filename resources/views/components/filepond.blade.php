@php

$allowDrop = $attributes->has('allowDrop') ? $attributes->get('allowDrop') : 'true';
$allowBrowse = $attributes->has('allowBrowse') ? $attributes->get('allowBrowse') : 'true';
$allowPaste = $attributes->has('allowPaste') ? $attributes->get('allowPaste') : 'true';
$allowMultiple = $attributes->has('allowMultiple') ? $attributes->get('allowMultiple') : 'false';
$allowFileSizeValidation = $attributes->has('allowFileSizeValidation') ? $attributes->get('allowFileSizeValidation') : 'true';
$minFileSize = $attributes->has('minFileSize') ? $attributes->get('minFileSize') : null;
$maxFileSize = $attributes->has('maxFileSize') ? $attributes->get('maxFileSize') : null;
$allowFileTypeValidation = $attributes->has('allowFileTypeValidation') ? $attributes->get('allowFileTypeValidation') : 'true';
$acceptedFileTypes = $attributes->has('acceptedFileTypes') ? $attributes->get('acceptedFileTypes') : '[]';
$allowImagePreview = $attributes->has('allowImagePreview') ? $attributes->get('allowImagePreview') : 'true';
$imagePreviewMinHeight = $attributes->has('imagePreviewMinHeight') ? $attributes->get('imagePreviewMinHeight') : 44;
$imagePreviewMaxHeight = $attributes->has('imagePreviewMaxHeight') ? $attributes->get('imagePreviewMaxHeight') : 256;

@endphp

<div
    wire:ignore
    x-data
    x-cloak
    x-init="() => {
        const pond = FilePond.create($refs.input, { credits: false });
        const callOnUploaded = {{ $attributes->has('callOnUploaded') ? $attributes->get('callOnUploaded') : '' }}
    
        pond.setOptions({
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                },
            },
            allowDrop: '{{ $allowDrop }}',
            allowBrowse: '{{ $allowBrowse }}',
            allowPaste: '{{ $allowPaste }}',
            allowMultiple: '{{ $allowMultiple }}',
            allowFileSizeValidation: '{{ $allowFileSizeValidation }}',
            minFileSize: '{{ $minFileSize }}',
            maxFileSize: '{{ $maxFileSize }}',
            allowFileTypeValidation: '{{ $allowFileTypeValidation }}',
            acceptedFileTypes: {{ $acceptedFileTypes }},
            allowImagePreview: '{{ $allowImagePreview }}',
            imagePreviewMinHeight: '{{ $imagePreviewMinHeight }}',
            imagePreviewMaxHeight: '{{ $imagePreviewMaxHeight }}',
            labelIdle: '{{ __('Drag & Drop your files or <span class="filepond--label-action"> Browse </span>') }}',
            labelInvalidField: '{{ __('Field contains invalid files') }}',
            labelFileWaitingForSize: '{{ __('Waiting for size') }}',
            labelFileSizeNotAvailable: '{{ __('Size not available') }}',
            labelFileLoading: '{{ __('Loading') }}',
            labelFileLoadError: '{{ __('Error during load') }}',
            labelFileProcessing: '{{ __('Uploading') }}',
            labelFileProcessingComplete: '{{ __('Upload complete') }}',
            labelFileProcessingAborted: '{{ __('Upload cancelled') }}',
            labelFileProcessingError: '{{ __('Error during upload') }}',
            labelFileProcessingRevertError: '{{ __('Error during revert') }}',
            labelFileRemoveError: '{{ __('Error during remove') }}',
            labelTapToCancel: '{{ __('tap to cancel') }}',
            labelTapToRetry: '{{ __('tap to retry') }}',
            labelTapToUndo: '{{ __('tap to undo') }}',
            labelButtonRemoveItem: '{{ __('Remove') }}',
            labelButtonAbortItemLoad: '{{ __('Abort') }}',
            labelButtonRetryItemLoad: '{{ __('Retry') }}',
            labelButtonAbortItemProcessing: '{{ __('Cancel') }}',
            labelButtonUndoItemProcessing: '{{ __('Undo') }}',
            labelButtonRetryItemProcessing: '{{ __('Retry') }}',
            labelButtonProcessItem: '{{ __('Upload') }}',
            labelMaxFileSizeExceeded: '{{ __('File is too large') }}',
            labelMaxFileSize: '{{ __('Maximum file size is {filesize}') }}',
            labelMaxTotalFileSizeExceeded: '{{ __('Maximum total size exceeded') }}',
            labelMaxTotalFileSize: '{{ __('Maximum total file size is {filesize}') }}',
            labelFileTypeNotAllowed: '{{ __('File of invalid type') }}',
        });
    
        pond.credits = false;
    
        pond.on('processfile', (error, file) => {
            if (callOnUploaded) {
                $wire.call(callOnUploaded)
            }
        });
    
        window.addEventListener('{{ $attributes->has('resetKey') ? $attributes->get('resetKey') : 'filepond' }}', e => {
            pond.removeFiles();
        });
    }"
>
    <input
        type="file"
        x-ref="input"
    />
</div>
