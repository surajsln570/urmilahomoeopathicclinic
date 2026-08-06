@props([
    'variant' => 'normal',
])

@php
    $variants = [
        'normal' => '',
        'between' => 'justify-between',
        'center' => 'justify-center',
        'around' => 'justify-around',
    ];
@endphp

<div {{ $attributes->merge([
    'class' => 'flex flex-row items-center ' . ($variants[$variant] ?? ''),
]) }}>
    {{ $slot }}
</div>
