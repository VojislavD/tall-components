@php

$placeholder = $attributes->has('placeholder') ? $attributes->get('placeholder') : '';
$readOnly = $attributes->has('readOnly') ? $attributes->get('readOnly') : false;

if ($attributes->has('toolbar')) {
    $toolbar = $attributes->get('toolbar');
} else {
    $toolbar = "
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        ['link', 'formula'],

        [{ 'header': 1 }, { 'header': 2 }], 
        [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],

        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']
        ";
}

@endphp

<div wire:ignore x-init="
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: '{{ $placeholder }}',
        readOnly: '{{ $readOnly }}',
        modules: {
            toolbar: [
                {{ $toolbar }}
            ],
        }
    })

    const input = document.getElementById('quill-input')

    quill.on('text-change', () => {
        input.dispatchEvent(new CustomEvent('input', {
            detail: quill.root.innerHTML
        }))
    })

    $nextTick(() => { quill.root.innerHTML = input.value });
">
    <div id="quill-editor">{{ $attributes->wire('model') }}</div>

    <input type="text" id="quill-input" hidden {{ $attributes->wire('model') }}>
</div>
