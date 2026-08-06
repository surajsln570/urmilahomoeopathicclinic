@props([
    'label' => null,
    'type' => 'text',
    'required' => false,
])

<div class="w-full" x-data="{ value: '' }">
    @if ($label)
        <label for="{{ $attributes->get('id') }}" class="mb-2 block text-sm font-semibold text-gray-700">
            {{ $label }}

            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input x-model="value" type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-1 focus:ring-blue-500',
        ]) }}
        :class="value ? 'bg-yellow-100' : 'bg-white'" />
</div>
