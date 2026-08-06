@props([
    'class' => '',
])

<div {{ $attributes->merge([
    'class' => 'p-2 md:p-3 lg:p-4 ' . $class,
]) }}>
    {{ $slot }}
</div>
