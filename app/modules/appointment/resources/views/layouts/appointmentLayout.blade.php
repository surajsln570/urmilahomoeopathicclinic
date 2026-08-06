@extends('dashboard::layouts.dashboardLayout')
@section('content')
    <div class="flex gap-6">

        <!-- Appointment Sidebar -->
        <aside class="w-56 shrink-0 bg-white border border-gray-200 rounded-lg">

            <div class="px-4 py-3 border-b">
                <h2 class="font-semibold text-gray-700">
                    Appointment
                </h2>
            </div>

            <nav class="py-2">

                <a href="{{ route('dash-appointment') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Dashboard
                </a>

                <a href="{{ route('appointment.bookings') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Bookings
                </a>

                <a href="{{ route('appointment.slots') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Time Slots
                </a>

                <a href="{{ route('appointment.holidays') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Holidays
                </a>

                <a href="{{ route('appointment.settings') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Settings
                </a>

            </nav>
        </aside>

        <div class="flex-1">
            @yield('appointment-content')
        </div>

    </div>
@endsection
