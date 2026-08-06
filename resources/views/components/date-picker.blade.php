@props([
    'name' => 'date',
    'label' => 'Select Date',
    'value' => '',
    'required' => false,
])

<div class="mb-4">
    <label for="{{ $name }}" class="block mb-2 font-medium">
        {{ $label }}
    </label>

    <input type="date" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        @required($required)
        {{ $attributes->merge([
            'class' => 'w-full border rounded-lg px-3 py-2',
        ]) }}>
</div>
