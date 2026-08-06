<div x-data="{
    isMenuOpen: false,
    treatOpen: false,
    profileOpen: false,
    viewTreatment: false
}" class="fixed top-0 left-0 w-full h-[100px] bg-white shadow-lg z-50">
    <x-website::container class="h-full">
        <div class="grid grid-cols-2 lg:grid-cols-12 items-center h-full">
            <div class="lg:col-span-3">
                <x-website::homescreen.logo />
            </div>
            <div class="hidden lg:flex col-span-8 gap-4 items-center">
                <a href="/" class="hover:scale-105 transition">
                    Home
                </a>
                <div class="relative">
                    <div @click="treatOpen = !treatOpen"
                        class="flex items-center gap-1 cursor-pointer hover:scale-105 transition">
                        <span class="text-gray-600 font-medium">Treatments</span>
                        <span :class="treatOpen ? '-rotate-90' : ''" class="transition text-2xl">
                            ▼
                        </span>
                    </div>
                    <div x-show="treatOpen" @click.outside="treatOpen = false"
                        class="absolute top-[50px] left-0 bg-white shadow rounded p-2 w-[150px]">
                        <template x-for="i in 6">
                            <div class="p-2 hover:bg-gray-100 text-sm">
                                Dolor Sitamet
                            </div>
                        </template>
                    </div>
                </div>

                <a href="/appointment" class="hover:scale-105 transition">
                    Book Appointment
                </a>

                <a href="/consultation" class="hover:scale-105 transition">
                    Online Consultation
                </a>

                <a href="/blogs" class="hover:scale-105 transition">
                    Blogs
                </a>

                <a href="#footer" class="hover:scale-105 transition">
                    Contact Us
                </a>
            </div>
            <div class="hidden lg:flex justify-end relative">
                <a href="/dashboard">
                    <div
                        class="h-[50px] w-[50px] bg-gray-200 rounded-full flex items-center justify-center cursor-pointer">
                        👤
                    </div>
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex justify-end lg:hidden">
                <button @click="isMenuOpen = !isMenuOpen" class="text-3xl">
                    ☰
                </button>
            </div>
        </div>
    </x-website::container>

    {{-- Mobile Overlay --}}
    <div x-show="isMenuOpen" x-cloak @click="isMenuOpen = false" class="fixed inset-0 bg-black/30 z-40"></div>

    {{-- Mobile Menu --}}
    <div x-show="isMenuOpen" x-cloak class="fixed top-0 left-0 w-[80%] h-full bg-white z-50 p-5 overflow-y-auto">
        <div class="flex flex-col gap-4">

            @php
                $links = ['home', 'about-us', 'treatments', 'book-appointment', 'gallery'];
            @endphp

            @foreach ($links as $link)
                <a href="/{{ $link === 'home' ? '' : $link }}" class="border-b p-2">
                    {{ ucfirst(str_replace('-', ' ', $link)) }}
                </a>
            @endforeach

        </div>

        <div class="mt-10 flex justify-between">
            <a href="/login">
                <x-website::button variant="success">Login</x-website::button>
            </a>
        </div>
    </div>
</div>
