@extends('website::layouts.mainlayout')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">
                    Book Appointment
                </h2>
                <p class="text-center text-gray-500 mb-8">
                    Fill in your details to schedule an appointment.
                </p>
                <div id="formAlert" class="hidden mb-6 rounded-lg border p-4"></div>
                <form id="appointmentForm" method="POST" action={{ route('appointment.store') }}>
                    @csrf
                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">
                            Full Name
                        </label>
                        <input type="text" id="patient_name" name="patient_name"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="Enter your name" required>
                    </div>
                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">
                            Mobile Number
                        </label>
                        <input type="tel" id="patient_mobile" name="patient_mobile" maxlength="10"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                            placeholder="9876543210" required>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold">
                            Appointment Date
                        </label>
                        <input type="date" id="date" name="date" min="{{ date('Y-m-d') }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div class="mb-8">
                        <label class="block mb-3 font-semibold">
                            Available Time Slots
                        </label>
                        <div id="slot-loader" class="hidden text-blue-600 mb-2">
                            Loading slots...
                        </div>
                        <div id="slots-container" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <p class="text-gray-500 col-span-full">
                                Please select a date first.
                            </p>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg">
                        Book Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dateInput = document.getElementById('date');
        const slotContainer = document.getElementById('slots-container');
        const loader = document.getElementById('slot-loader');
        const form = document.getElementById('appointmentForm');
        const alertBox = document.getElementById('formAlert');

        dateInput.addEventListener('change', function() {
            const date = this.value;
            loader.classList.remove('hidden');
            slotContainer.innerHTML = '';
            fetch(`http://localhost:8000/appointment/slots?date=${date}`)
                .then(async response => {
                    const text = await response.text();
                    console.log("Status:", response.status);
                    console.log("Response:", text);

                    if (!response.ok) {
                        throw new Error(text);
                    }

                    return JSON.parse(text);
                })
                .then(data => {
                    loader.classList.add('hidden');
                    if (data.length === 0) {
                        slotContainer.innerHTML =
                            `<p class="text-red-500 col-span-full">
                        No slots available.
                    </p>`;
                        return;
                    }
                    data.forEach(slot => {
                        slotContainer.innerHTML += `
                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            name="time_slot_id"
                            value="${slot.id}"
                            class="hidden peer"
                            required
                        >

                        <div class="border rounded-lg p-3 text-center
                            peer-checked:bg-blue-600
                            peer-checked:text-white
                            peer-checked:border-blue-600
                            hover:border-blue-600">

                            ${slot.label}
                        </div>
                    </label>
                `;
                    });

                })
                .catch(error => {

                    console.error('Error:', error);

                    loader.classList.add('hidden');

                    slotContainer.innerHTML =
                        `<p class="text-red-500 col-span-full">
                    Unable to load slots.
                </p>`;
                });

        });

        // form.addEventListener('submit', async function(e) {
        //     e.preventDefault();

        //     const selectedSlot = document.querySelector('input[name="time_slot_id"]:checked');

        //     if (!selectedSlot) {
        //         alertBox.innerHTML = 'Please select a time slot.';
        //         alertBox.className = 'mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700';
        //         alertBox.classList.remove('hidden');
        //         return;
        //     }

        //     const payload = {
        //         _token: document.querySelector('input[name="_token"]').value,
        //         patient_name: document.getElementById('patient_name').value,
        //         patient_mobile: document.getElementById('patient_mobile').value,
        //         date: document.getElementById('date').value,
        //         time_slot_id: selectedSlot.value,
        //     };

        //     try {
        //         const response = await fetch('{{ route('appointment.store') }}', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'Accept': 'application/json',
        //             },
        //             body: JSON.stringify(payload),
        //         });

        //         const result = await response.json();

        //         if (!response.ok || !result.success) {
        //             alertBox.innerHTML = result.message || 'Something went wrong.';
        //             alertBox.className = 'mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700';
        //             alertBox.classList.remove('hidden');
        //             return;
        //         }

        //         alertBox.innerHTML = result.message || 'Appointment booked successfully!';
        //         alertBox.className = 'mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700';
        //         alertBox.classList.remove('hidden');
        //         form.reset();
        //         slotContainer.innerHTML =
        //             `<p class="text-gray-500 col-span-full">Please select a date first.</p>`;

        //     } catch (err) {
        //         alertBox.innerHTML = 'Network error. Please try again.';
        //         alertBox.className = 'mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700';
        //         alertBox.classList.remove('hidden');
        //     }
        // });
    </script>
@endsection
