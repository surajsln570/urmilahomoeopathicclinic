<div x-data="{ open: false }" @keydown.escape.window="open = false">

    <!-- Trigger -->
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <!-- Backdrop -->
    <div x-show="open" x-transition class="fixed inset-0 z-40 bg-black/50" @click="open = false"></div>

    <!-- Modal -->
    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full {{ $maxWidth }} rounded-xl bg-white shadow-xl" @click.stop>
            <!-- Header -->
            <div class="flex items-center justify-between border-b p-5">
                <h2 class="text-lg font-semibold">
                    {{ $title }}
                </h2>

                <button @click="open = false" class="text-2xl leading-none text-gray-500 hover:text-black">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="p-5">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @isset($footer)
                <div class="border-t p-5">
                    {{ $footer }}
                </div>
            @endisset

        </div>
    </div>

</div>
