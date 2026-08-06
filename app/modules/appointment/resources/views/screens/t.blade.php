@extends('dashboard::layouts.dashboardLayout')
@section('page-title', 'Appointments')
@section('content')
    <div class="min-h-screen bg-slate-50">
        <div class="rounded-lg bg-gradient-to-r from-indigo-400 via-blue-600 to-cyan-200 p-2 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">
                        Appointment Management
                    </h1>
                    <p class="mt-2 text-blue-100">
                        Manage all appointments from one place.
                    </p>
                </div>
                <button onclick="openCreateModal()"
                    class="rounded-lg bg-white px-6 py-3 font-semibold text-indigo-600 shadow-lg transition hover:scale-105">
                    + Add Appointment
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div id="alertBox" class="mt-6 hidden rounded-lg border p-4"></div>

        <div class="mt-4 flex flex-col gap-2">
            @forelse($appointments as $appointment)
                <div
                    class="flex items-center justify-between rounded-lg bg-white p-4 shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex items-center gap-6">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">
                                {{ $appointment->patient_name }}
                            </h2>
                            <p class="text-sm text-slate-500">
                                {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}
                                &middot;
                                {{ $appointment->patient_mobile }}
                                @if ($appointment->timeSlot)
                                    &middot;
                                    {{ $appointment->timeSlot->day }}
                                    ({{ \Carbon\Carbon::parse($appointment->timeSlot->start_time)->format('h:i A') }}
                                    -
                                    {{ \Carbon\Carbon::parse($appointment->timeSlot->end_time)->format('h:i A') }})
                                @endif
                            </p>
                        </div>
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            onclick="openEditModal(
                                '{{ $appointment->id }}',
                                @js($appointment->date),
                                @js($appointment->patient_name),
                                @js($appointment->patient_mobile),
                                @js($appointment->time_slot_id)
                            )"
                            class="rounded-xl bg-blue-500 px-3 py-1 font-semibold text-white transition hover:bg-blue-600">
                            Edit
                        </button>

                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this appointment?')"
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
                            📅
                        </div>

                        <h2 class="mt-6 text-3xl font-bold text-slate-700">
                            No Appointments Available
                        </h2>

                        <p class="mt-3 text-slate-500">
                            Click below to book your first appointment.
                        </p>

                        <button onclick="openCreateModal()"
                            class="mt-8 rounded-xl bg-indigo-600 px-8 py-3 font-semibold text-white transition hover:bg-indigo-700">
                            + Add Appointment
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Modal -->
        <div id="appointmentModal"
            class="fixed inset-0 top-0 z-50 hidden items-center justify-center bg-black/60 p-10 backdrop-blur-sm">
            <div class="w-full max-w-3xl overflow-hidden rounded-3xl bg-white px-10 py-5 shadow-2xl">
                <div class="flex items-center justify-between border-b px-8 py-2">
                    <div>
                        <h2 id="modalTitle" class="text-2xl font-bold">
                            Add Appointment
                        </h2>
                        <p class="text-sm text-slate-500">
                            Fill in the appointment details.
                        </p>
                    </div>

                    <button type="button" onclick="closeModal()" class="text-4xl text-slate-500 hover:text-red-500">
                        &times;
                    </button>
                </div>

                <form id="appointmentForm" class="space-y-6 p-6">
                    @csrf
                    <input type="hidden" id="appointmentId" value="">

                    <!-- Patient Name -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Patient Name
                        </label>

                        <input id="patient_name" name="patient_name" type="text" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <!-- Patient Mobile -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Patient Mobile
                        </label>

                        <input id="patient_mobile" name="patient_mobile" type="text" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Date
                        </label>

                        <input id="date" name="date" type="date" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <!-- Time Slot (today only: {{ \Carbon\Carbon::now()->format('l') }}) -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Time Slot ({{ \Carbon\Carbon::now()->format('l') }})
                        </label>

                        <select id="time_slot_id" name="time_slot_id" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            <option value="">Select a time slot</option>
                            @php $today = \Carbon\Carbon::now()->format('l'); @endphp
                            @foreach ($timeSlots as $slot)
                                @if ($slot->day === $today)
                                    <option value="{{ $slot->id }}">
                                        {{ $slot->day }} —
                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                        to
                                        {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <p id="formError" class="hidden text-sm text-red-600"></p>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeModal()"
                            class="rounded-lg border border-slate-300 px-6 py-1 font-semibold hover:bg-slate-100">
                            Cancel
                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-8 py-1 font-semibold text-white transition hover:bg-indigo-700">
                            Save Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let isEditMode = false;

        function openCreateModal() {
            isEditMode = false;
            document.getElementById('modalTitle').innerHTML = 'Add Appointment';
            document.getElementById('appointmentForm').reset();
            document.getElementById('appointmentId').value = '';
            document.getElementById('formError').classList.add('hidden');
            document.getElementById('appointmentModal').classList.remove('hidden');
            document.getElementById('appointmentModal').classList.add('flex');
        }

        function openEditModal(id, date, patientName, patientMobile, timeSlotId) {
            isEditMode = true;
            document.getElementById('modalTitle').innerHTML = 'Edit Appointment';
            document.getElementById('appointmentId').value = id;
            document.getElementById('date').value = date;
            document.getElementById('patient_name').value = patientName;
            document.getElementById('patient_mobile').value = patientMobile;
            document.getElementById('time_slot_id').value = timeSlotId;
            document.getElementById('formError').classList.add('hidden');
            document.getElementById('appointmentModal').classList.remove('hidden');
            document.getElementById('appointmentModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('appointmentModal').classList.remove('flex');
            document.getElementById('appointmentModal').classList.add('hidden');
        }

        document.getElementById('appointmentForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('appointmentId').value;
            const url = isEditMode ? `/appointment/${id}` : `/appointment/store`;
            const errorBox = document.getElementById('formError');

            const payload = {
                _token: document.querySelector('input[name="_token"]').value,
                date: document.getElementById('date').value,
                patient_name: document.getElementById('patient_name').value,
                patient_mobile: document.getElementById('patient_mobile').value,
                time_slot_id: document.getElementById('time_slot_id').value,
            };

            if (isEditMode) {
                payload._method = 'PUT';
            }

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const result = await response.json();

                if (!response.ok) {
                    errorBox.innerHTML = result.message || 'Something went wrong.';
                    errorBox.classList.remove('hidden');
                    return;
                }

                window.location.reload();
            } catch (err) {
                errorBox.innerHTML = 'Network error. Please try again.';
                errorBox.classList.remove('hidden');
            }
        });

        window.onclick = function(event) {
            let modal = document.getElementById('appointmentModal');
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
