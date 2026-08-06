@extends('dashboard::layouts.dashboardLayout')
@section('page-title', 'Treatment')
@section('content')
    <div class="min-h-screen bg-slate-50">
        <div class="rounded-lg bg-gradient-to-r from-indigo-400 via-blue-600 to-cyan-200 p-2 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">
                        Treatment Management
                    </h1>
                    <p class="mt-2 text-blue-100">
                        Manage all treatments from one place.
                    </p>
                </div>
                <button onclick="openCreateModal()"
                    class="rounded-lg bg-white px-6 py-3 font-semibold text-indigo-600 shadow-lg transition hover:scale-105">
                    + Add Treatment
                </button>
            </div>
        </div>
        @if (session('success'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex flex-col gap-2">
            @forelse($treatments as $treatment)
                <div
                    class="flex justify-between rounded-lg bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative flex">
                        @if ($treatment->image)
                            <img src="{{ asset($treatment->image) }}" class="h-[50px] object-cover">
                        @else
                            <div class="flex h-64 items-center justify-center bg-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-slate-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 17v-2a4 4 0 014-4h4m0 0l-2-2m2 2l-2 2M7 7h10" />
                                </svg>
                            </div>
                        @endif
                        <h2 class="text-2xl font-bold text-slate-800">
                            {{ $treatment->disease }}
                        </h2>
                    </div>
                    <div class="flex items-center gap-2">

                        <button
                            onclick="openEditModal(
                            '{{ $treatment->id }}',
                            @js($treatment->disease),
                            @js($treatment->symptoms),
                            @js($treatment->description)
                        )"
                            class=" rounded-xl bg-blue-500 px-3 py-1 font-semibold text-white transition hover:bg-blue-600">

                            Edit

                        </button>

                        <form action="{{ route('treatment.delete', $treatment->id) }}" method="POST" class="flex-1">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this treatment?')"
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

                            🩺

                        </div>

                        <h2 class="mt-6 text-3xl font-bold text-slate-700">

                            No Treatments Available

                        </h2>

                        <p class="mt-3 text-slate-500">

                            Click below to create your first treatment.

                        </p>

                        <button onclick="openCreateModal()"
                            class="mt-8 rounded-xl bg-indigo-600 px-8 py-3 font-semibold text-white transition hover:bg-indigo-700">

                            + Add Treatment

                        </button>

                    </div>

                </div>
            @endforelse

        </div>
        <div id="treatmentModal"
            class="fixed inset-0 top-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-10">

            <div class="w-full px-10 py-5 max-w-3xl overflow-hidden rounded-3xl bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b px-8 py-2">

                    <div>

                        <h2 id="modalTitle" class="text-2xl font-bold">

                            Add Treatment

                        </h2>

                        <p class="text-sm text-slate-500">

                            Fill in the treatment details.

                        </p>

                    </div>

                    <button onclick="closeModal()" class="text-4xl text-slate-500 hover:text-red-500">

                        &times;

                    </button>

                </div>

                <form id="treatmentForm" method="POST" enctype="multipart/form-data"
                    action="{{ route('treatment.store') }}" class="space-y-6 p-6">

                    @csrf

                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <!-- Disease -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Disease Name
                        </label>

                        <input id="disease" name="disease" type="text" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>

                    <!-- Symptoms -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Symptoms
                        </label>

                        <textarea id="symptoms" name="symptoms" rows="1" required
                            class="w-full rounded-lg border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"></textarea>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Description
                        </label>

                        <textarea id="description" name="description" rows="1" required
                            class="w-full rounded-lg border border-slate-300 px-4 py-1 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"></textarea>
                    </div>

                    <!-- Image Upload -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Treatment Image
                        </label>

                        <div class="rounded-2xl border-2 border-dashed border-slate-300 p-2">

                            <img id="previewImage" src="" class="mb-4 hidden h-10 rounded-lg object-cover">

                            <input type="file" id="image" name="image" accept="image/*"
                                onchange="previewFile(event)" class="block w-full text-sm">

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-4">

                        <button type="button" onclick="closeModal()"
                            class="rounded-lg border border-slate-300 px-6 py-1 font-semibold hover:bg-slate-100">

                            Cancel

                        </button>

                        <button type="submit"
                            class="rounded-lg bg-indigo-600 px-8 py-1 font-semibold text-white transition hover:bg-indigo-700">

                            Save Treatment

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
    <script>
        function openCreateModal() {
            document.getElementById('modalTitle').innerHTML = 'Add Treatment';
            document.getElementById('treatmentForm').action = "{{ route('treatment.store') }}";
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('disease').value = '';
            document.getElementById('symptoms').value = '';
            document.getElementById('description').value = '';
            document.getElementById('image').value = '';
            document.getElementById('previewImage').src = '';
            document.getElementById('previewImage').classList.add('hidden');
            document.getElementById('treatmentModal').classList.remove('hidden');
            document.getElementById('treatmentModal').classList.add('flex');
        }

        function openEditModal(id, disease, symptoms, description) {
            document.getElementById('modalTitle').innerHTML = 'Edit Treatment';
            document.getElementById('treatmentForm').action = '/treatment/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('disease').value = disease;
            document.getElementById('symptoms').value = symptoms;
            document.getElementById('description').value = description;
            document.getElementById('previewImage').classList.add('hidden');
            document.getElementById('treatmentModal').classList.remove('hidden');
            document.getElementById('treatmentModal').classList.add('flex');
        }

        function closeModal() {

            document.getElementById('treatmentModal').classList.remove('flex');
            document.getElementById('treatmentModal').classList.add('hidden');

        }

        function previewFile(event) {

            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('previewImage');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        window.onclick = function(event) {
            let modal = document.getElementById('treatmentModal');
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
