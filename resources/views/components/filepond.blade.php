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
