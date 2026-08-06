@props([
    'variant' => 'p',
])

@php
    $styles = [
        'h1' => 'text-4xl md:text-5xl font-bold text-gray-900',
        'h2' => 'text-3xl md:text-4xl font-bold text-gray-900',
        'h3' => 'text-2xl md:text-3xl font-semibold text-gray-900',
        'h4' => 'text-xl md:text-2xl font-semibold text-gray-900',

        'p' => 'text-base text-gray-700 leading-relaxed',
        'sm' => 'text-sm text-gray-600',
        'xs' => 'text-xs text-gray-500',

        'label' => 'text-sm font-medium text-gray-700',
        'caption' => 'text-xs text-gray-500',
    ];

    $tag = match ($variant) {
        'h1' => 'h1',
        'h2' => 'h2',
        'h3' => 'h3',
        'h4' => 'h4',
        default => 'p',
    };
@endphp

<{{ $tag }} {{ $attributes->merge([
    'class' => $styles[$variant] ?? $styles['p'],
]) }}>
    {{ $slot }}
    </{{ $tag }}>
