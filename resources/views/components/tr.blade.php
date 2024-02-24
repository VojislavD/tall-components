@props(['index' => 0, 'href' => null])

@php
    $class = 'w-full border-y hover:bg-slate-200';

    if ($index % 2 !== 0) {
        $class .= ' bg-slate-50';
    }

    if ($href) {
        $class .= ' cursor-pointer';
    }
@endphp

<tr {{ $attributes->merge(['class' => $class]) }} @if($href) onclick="window.location='{{ $href }}'" @endif>
    {{ $slot }}
</tr>
