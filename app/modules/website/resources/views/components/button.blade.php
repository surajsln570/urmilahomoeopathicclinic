@props([
    'variant' => 'primary',
    'type' => 'button',
    'disabled' => false,
])

@php
    $baseStyle = '
        inline-flex items-center w-full justify-center
        px-5 py-2.5
        rounded-lg
        font-medium
        transition-all duration-300
        shadow-md
        cursor-pointer
        focus:outline-none focus:ring-2 focus:ring-offset-2
        active:scale-95
        disabled:opacity-50 disabled:cursor-not-allowed
    ';

    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',

        'secondary' => 'bg-slate-200 text-slate-800 hover:bg-slate-300 focus:ring-slate-400',

        'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus:ring-emerald-500',

        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',

        'outline' => 'border border-slate-300 text-slate-700 hover:bg-slate-100 focus:ring-slate-400',

        'dark' => 'bg-slate-900 text-white hover:bg-slate-800 focus:ring-slate-700',
    ];
@endphp

<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' => $baseStyle . 'w-full ' . ($variants[$variant] ?? $variants['primary']),
    ]) }}>
    {{ $slot }}
</button>
