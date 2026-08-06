<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $navItems = [
        ['title' => 'Dashboard', 'route' => 'dashboard'],
        ['title' => 'Users', 'route' => 'users'],
        [
            'title' => 'Appointment',
            'child' => [
                ['title' => 'All Appointment', 'route' => 'dash-appointment'],
                ['title' => 'Time Slots', 'route' => 'appointment.slots'],
            ],
        ],

        [
            'title' => 'CMS',
            'child' => [
                ['title' => 'Hero Image', 'route' => 'heroimage'],
                ['title' => 'Treatments', 'route' => 'dashtreatment.show'],
            ],
        ],
    ];
@endphp
<script>
    function toggleMenu(id) {
        const menu = document.getElementById(id);
        const arrow = document.getElementById('arrow-' + id);

        if (!menu) return;

        // toggle menu
        menu.classList.toggle('hidden');

        // rotate arrow
        if (arrow) {
            arrow.classList.toggle('rotate-90');
        }
    }
</script>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen flex"
    style="font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;">
    <aside
        class="w-60 shrink-0 border-r border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] flex flex-col min-h-screen">
        <a href="/" class="h-14 flex items-center px-5 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <svg viewBox="0 0 80 19" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="h-4 text-[#F53003] dark:text-[#FF4433]">
                <path d="M3 0H0V18H9V15H3V0Z" fill="currentColor" />
                <path
                    d="M20 7C19.6 6.4 19 5.9 18.3 5.5C17.5 5.1 16.7 4.9 15.9 4.9C15 4.9 14.1 5.1 13.3 5.4C12.5 5.8 11.8 6.2 11.3 6.8C10.7 7.4 10.3 8.1 10 8.9C9.7 9.7 9.5 10.5 9.5 11.4C9.5 12.3 9.7 13.1 10 13.9C10.3 14.7 10.7 15.4 11.3 16C11.8 16.6 12.5 17.1 13.3 17.4C14.1 17.8 15 18 15.9 18C16.7 18 17.5 17.8 18.3 17.4C19 17 19.6 16.5 20 15.9V17.7H23V5.2H20V7ZM19.7 13.4C19.5 14 19.2 14.5 18.9 14.9C18.6 15.3 18.1 15.6 17.7 15.8C17.2 16 16.7 16.1 16.1 16.1C15.5 16.1 15 16 14.6 15.8C14.1 15.6 13.7 15.3 13.4 14.9C13.1 14.5 12.8 14 12.7 13.4C12.5 12.8 12.5 12.1 12.5 11.4C12.5 10.7 12.5 10 12.7 9.4C12.8 8.8 13.1 8.3 13.4 7.9C13.7 7.5 14.1 7.2 14.6 7C15 6.8 15.5 6.7 16.1 6.7C16.7 6.7 17.2 6.8 17.7 7C18.1 7.2 18.6 7.5 18.9 7.9C19.2 8.3 19.5 8.8 19.7 9.4C19.9 10 19.9 10.7 19.9 11.4C19.9 12.1 19.9 12.8 19.7 13.4Z"
                    fill="currentColor" />
            </svg>
            <span class=" text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC] tracking-tight">
                Urmila Homeo Clinic
            </span>
        </a>
        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

            @foreach ($navItems as $index => $item)
                {{-- NORMAL ITEM (no children) --}}
                @if (!isset($item['child']))
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-sm text-[#706f6c]
                  hover:text-[#1b1b18] hover:bg-[#f4f4f2] transition">

                        <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none">
                            <circle cx="8" cy="5" r="3" stroke="currentColor" stroke-width="1.2" />
                            <path d="M2 14c0-3.314 2.686-5 6-5s6 1.686 6 5" stroke="currentColor" stroke-width="1.2"
                                stroke-linecap="round" />
                        </svg>

                        {{ $item['title'] }}
                    </a>

                    {{-- PARENT WITH CHILDREN --}}
                @else
                    <div class="space-y-1">

                        {{-- Parent button --}}
                        <button type="button"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-sm
                   text-[#706f6c] hover:text-[#1b1b18] hover:bg-[#f4f4f2] transition"
                            onclick="toggleMenu('menu-{{ $index }}')">

                            <span class="flex items-center gap-3">
                                {{-- icon --}}
                                <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none">
                                    <circle cx="8" cy="5" r="3" stroke="currentColor"
                                        stroke-width="1.2" />
                                    <path d="M2 14c0-3.314 2.686-5 6-5s6 1.686 6 5" stroke="currentColor"
                                        stroke-width="1.2" stroke-linecap="round" />
                                </svg>

                                {{ $item['title'] }}
                            </span>

                            {{-- Arrow --}}
                            <svg id="arrow-menu-{{ $index }}" class="w-4 h-4 transition-transform duration-200"
                                viewBox="0 0 16 16" fill="none">
                                <path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>

                        {{-- Children --}}
                        <div id="menu-{{ $index }}" class="hidden ml-6 space-y-1 border-l border-[#e3e3e0] pl-3">

                            @foreach ($item['child'] as $child)
                                <a href="{{ route($child['route']) }}"
                                    class="block px-3 py-2 rounded-sm text-[#A1A09A]
                          hover:text-[#1b1b18] hover:bg-[#f4f4f2] transition">
                                    {{ $child['title'] }}
                                </a>
                            @endforeach

                        </div>
                    </div>
                @endif
            @endforeach

        </nav>
        <div class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] px-3 py-3">
            <div class="flex items-center gap-3 px-2 py-1.5">
                <span
                    class="w-7 h-7 rounded-full bg-[#f53003] text-white text-xs font-semibold flex items-center justify-center shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] truncate">
                        {{ auth()->user()->name ?? 'User' }}
                    </p>
                    <p class="text-[11px] text-[#706f6c] dark:text-[#A1A09A] truncate">
                        {{ auth()->user()->email ?? 'user@example.com' }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Sign out"
                        class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors">
                        <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none">
                            <path d="M6 2H3a1 1 0 00-1 1v10a1 1 0 001 1h3M10 5l3 3-3 3M13 8H6" stroke="currentColor"
                                stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>
    <div class="flex-1 flex flex-col min-h-screen overflow-hidden">
        <header
            class="h-14 shrink-0 flex items-center justify-between px-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615]">
            <h1 class="text-sm font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                @yield('page-title', 'Dashboard')
            </h1>
            <div class="flex items-center gap-3">
                <div
                    class="hidden sm:flex items-center gap-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm px-3 py-1 text-sm text-[#706f6c] dark:text-[#A1A09A] bg-[#FDFDFC] dark:bg-[#0a0a0a] w-48">
                    <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 16 16" fill="none">
                        <circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.2" />
                        <path d="M10 10l3.5 3.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                    <span class="text-[13px]">Search…</span>
                </div>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-sm border border-transparent hover:border-[#e3e3e0] dark:hover:border-[#3E3E3A] text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors relative">
                    <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none">
                        <path d="M8 1.5a4.5 4.5 0 00-4.5 4.5v2.5L2 10.5h12l-1.5-2V6A4.5 4.5 0 008 1.5z"
                            stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" />
                        <path d="M6.5 10.5a1.5 1.5 0 003 0" stroke="currentColor" stroke-width="1.2" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-[#f53003]"></span>
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="flex bg-red-500 text-white hover:bg-[#491509] active:scale-95 py-1.5 px-3 rounded-lg"
                        type="submit">Logout
                    </button>
                </form>
            </div>
        </header>
        <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
            @hasSection('content')
                <div
                    class="bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm
                            shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] p-6">
                    @yield('content')
                </div>
            @endif
        </main>
    </div>
</body>

</html>
