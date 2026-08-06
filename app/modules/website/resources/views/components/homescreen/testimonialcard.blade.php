@props(['testimony'])

<div class="w-full bg-white shadow-lg p-5 gap-2 rounded-lg flex flex-col">

    {{-- Stars --}}
    <div class="flex gap-1">
        @for ($i = 1; $i <= $testimony['rating']; $i++)
            <span class="text-yellow-500 text-lg">★</span>
        @endfor
    </div>

    {{-- Content --}}
    <p class="text-sm tracking-tight text-gray-700">
        {{ $testimony['content'] }}
    </p>

    {{-- User Info --}}
    <div class="flex items-center gap-2 mt-2">

        <img src="{{ $testimony['image'] }}" alt="{{ $testimony['name'] }}"
            class="w-[70px] h-[70px] rounded-full object-cover" />

        <div class="flex flex-col">

            <h3 class="font-semibold text-lg">
                {{ $testimony['name'] }}
            </h3>

            <p class="text-sm text-gray-500">
                {{ $testimony['location'] }}
            </p>

        </div>

    </div>

</div>
