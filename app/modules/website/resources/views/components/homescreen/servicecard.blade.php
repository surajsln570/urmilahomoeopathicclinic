@props(['treatment'])

<div class="relative rounded-lg w-full">

    <img src="{{ asset($treatment->image) }}" alt="{{ $treatment['title'] }}"
        class="h-[300px] w-full object-cover rounded-lg" onerror="#" />

    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-[90%] p-2 bg-white rounded-lg text-center">

        <x-website::typography variant="h3">
            {{ $treatment['disease'] }}
        </x-website::typography>

        <x-website::typography variant="h4">
            {{ $treatment['description'] }}
        </x-website::typography>

    </div>

</div>
