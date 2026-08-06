@props([
    'variant' => 'normal',
])

@php
    $variants = [
        'normal' => '',
        'between' => 'justify-between',
        'center' => 'items-center',
    ];
@endphp

<div {{ $attributes->merge([
    'class' => 'flex flex-col ' . ($variants[$variant] ?? ''),
]) }}>
    {{ $slot }}
</div>
