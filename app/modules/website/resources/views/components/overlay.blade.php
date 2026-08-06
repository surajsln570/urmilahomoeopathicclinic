@props([
    'opacity' => '20',
])

<div
    {{ $attributes->merge([
        'class' => "bg-black/{$opacity} fixed min-h-screen w-full left-0 top-0 z-40",
    ]) }}>
    {{ $slot }}
</div>
