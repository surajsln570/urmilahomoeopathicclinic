@extends('dashboard::layouts.dashboardLayout')
@section('page-title', 'Time Slots')
@section('content')
    <div class="min-h-screen bg-slate-50">
        <div class="rounded-lg bg-gradient-to-r from-indigo-400 via-blue-600 to-cyan-200 p-2 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">
                        Time Slot Management
                    </h1>
                    <p class="mt-2 text-blue-100">
                        Manage all weekly time slots from one place.
                    </p>
                </div>
                <button onclick="openCreateModal()"
                    class="rounded-lg bg-white px-6 py-3 font-semibold text-indigo-600 shadow-lg transition hover:scale-105">
                    + Add Time Slot
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-4 flex flex-col gap-2">
            @forelse($timeSlots as $timeSlot)
                <div
                    class="flex items-center justify-between rounded-lg bg-white p-4 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex items-center gap-6">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">
                                {{ $timeSlot->day }}
                            </h2>
                            <p class="text-sm text-slate-500">
                                {{ \Carbon\Carbon::parse($timeSlot->start_time)->format('h:i A') }}
                                &mdash;
                                {{ \Carbon\Carbon::parse($timeSlot->end_time)->format('h:i A') }}
                            </p>
                        </div>
                        @if ($timeSlot->status)
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Active
                            </span>
                        @else
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Inactive
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            onclick="openEditModal(
                                '{{ $timeSlot->id }}',
                                @js($timeSlot->day),
                                @js($timeSlot->start_time),
                                @js($timeSlot->end_time),
                                @js((bool) $timeSlot->status)
                            )"
                            class="rounded-xl bg-blue-500 px-3 py-1 font-semibold text-white transition hover:bg-blue-600">
                            Edit
                        </button>

                        <form action="{{ url('/appointment/time-slots/' . $timeSlot->id . '/delete') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this time slot?')"
                                class="w-full rounded-xl bg-red-500 px-3 py-1 font-semibold text-white transition hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="rounded-3xl border-2 border-dashed border-slate-300 bg-white py-20 text-center">
                        <div class="text-7xl">
                            🕒
                        </div>

                        <h2 class="mt-6 text-3xl font-bold text-slate-700">
                            No Time Slots Available
                        </h2>

                        <p class="mt-3 text-slate-500">
                            Click below to create your first time slot.
                        </p>

                        <button onclick="openCreateModal()"
                            class="mt-8 rounded-xl bg-indigo-600 px-8 py-3 font-semibold text-white transition hover:bg-indigo-700">
                            + Add Time Slot
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Modal -->
        <div id="timeSlotModal"
            class="fixed inset-0 top-0 z-50 hidden items-center justify-center bg-black/60 p-10 backdrop-blur-sm">
            <div class="w-full max-w-3xl overflow-hidden rounded-3xl bg-white px-10 py-5 shadow-2xl">
                <div class="flex items-center justify-between border-b px-8 py-2">
                    <div>
                        <h2 id="modalTitle" class="text-2xl font-bold">
                            Add Time Slot
                        </h2>
                        <p class="text-sm text-slate-500">
                            Fill in the time slot details.
                        </p>
                    </div>

                    <button onclick="closeModal()" class="text-4xl text-slate-500 hover:text-red-500">
                        &times;
                    </button>
                </div>

                <form id="timeSlotForm" method="POST" action="{{ url('/appointment/time-slots') }}" class="space-y-6 p-6">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <!-- Day -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Day
                        </label>

                        <select id="day" name="day" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            <option value="">Select a day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Start Time
                        </label>

                        <input id="start_time" name="start_time" type="time" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <!-- End Time -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            End Time
                        </label>

                        <input id="end_time" name="end_time" type="time" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-3">
                        <input id="status" name="status" type="checkbox" value="1" checked
                            class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="status" class="text-sm font-semibold text-slate-700">
                            Active
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeModal()"
                            class="rounded-lg border border-slate-300 px-6 py-1 font-semibold hover:bg-slate-100">
                            Cancel
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-8 py-1 font-semibold text-white transition hover:bg-indigo-700">
                            Save Time Slot
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('modalTitle').innerHTML = 'Add Time Slot';
            document.getElementById('timeSlotForm').action = "{{ url('/appointment/time-slots') }}";
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('day').value = '';
            document.getElementById('start_time').value = '';
            document.getElementById('end_time').value = '';
            document.getElementById('status').checked = true;
            document.getElementById('timeSlotModal').classList.remove('hidden');
            document.getElementById('timeSlotModal').classList.add('flex');
        }

        function openEditModal(id, day, startTime, endTime, status) {
            document.getElementById('modalTitle').innerHTML = 'Edit Time Slot';
            document.getElementById('timeSlotForm').action = '/appointment/time-slots/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('day').value = day;
            document.getElementById('start_time').value = startTime;
            document.getElementById('end_time').value = endTime;
            document.getElementById('status').checked = status;
            document.getElementById('timeSlotModal').classList.remove('hidden');
            document.getElementById('timeSlotModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('timeSlotModal').classList.remove('flex');
            document.getElementById('timeSlotModal').classList.add('hidden');
        }

        window.onclick = function(event) {
            let modal = document.getElementById('timeSlotModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                closeModal();
            }
        });
    </script>
@endsection
