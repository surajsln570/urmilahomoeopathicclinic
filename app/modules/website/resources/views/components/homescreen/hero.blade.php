@props(['heroImages'])
<section>

    <x-website::col class="flex-col-reverse lg:flex-row">

        {{-- Left Content --}}
        <x-website::col
            class="bg-gradient-to-tr from-background1 to-background3 p-2 lg:p-5 h-[350px] md:h-[400px] lg:h-[450px] w-full justify-between">

            <div>

                <x-website::typography variant="h1">
                    Urmila Homeo
                    <span class="text-emerald-600"> Clinic</span>
                </x-website::typography>

                <x-website::typography variant="h4">
                    Personalized homeopathic treatment for chronic and acute health conditions.
                    Safe, gentle, and permanent cure for your complete well-being.
                </x-website::typography>

                <x-website::row class="gap-4 mt-8">

                    <a href="#appointment">
                        <x-website::button variant="primary">
                            Book Appointment
                        </x-website::button>
                    </a>

                    <x-modal title="Call Us">

                        <x-slot:trigger>
                            <x-website::button variant="success">
                                Call Now
                            </x-website::button>
                        </x-slot:trigger>

                        <p class="mb-4">
                            Call us on:
                        </p>

                        <a href="tel:+917307271037" class="bg-success text-white px-4 py-2 rounded-lg inline-block">
                            +91 7307271037
                        </a>

                    </x-modal>

                </x-website::row>

            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-2 lg:gap-6">

                <div class="bg-white p-2 rounded-lg text-center">
                    <x-website::typography variant="h3">5+</x-website::typography>
                    <x-website::typography variant="p">Years Experience</x-website::typography>
                </div>

                <div class="bg-white p-2 rounded-lg text-center">
                    <x-website::typography variant="h3">10k+</x-website::typography>
                    <x-website::typography variant="p">Happy Patients</x-website::typography>
                </div>

                <div class="bg-white p-2 rounded-lg text-center">
                    <x-website::typography variant="h3">98%</x-website::typography>
                    <x-website::typography variant="p">Patient Satisfaction</x-website::typography>
                </div>

            </div>

        </x-website::col>

        {{-- Right Image --}}
        <div class="relative w-full">
            @if ($heroImages->isNotEmpty())
                <img src="{{ asset($heroImages[0]->heroimage) }}" alt="Doctor"
                    class="h-[300px] md:h-[400px] w-full lg:h-[520px] lg:rounded-bl-4xl object-cover" />
            @endif

            <div
                class="absolute lg:bottom-10 bottom-2 left-10 bg-white/90 backdrop-blur-md rounded-2xl px-5 py-4 shadow-lg">

                <div class="font-semibold text-gray-900">
                    Dr. Deepak Singh
                </div>

                <div class="text-sm text-gray-600">
                    BHMS (Homeopathic Consultant)
                </div>

            </div>

        </div>

    </x-website::col>
    <x-modal title="Add Patient">

        <x-slot:trigger>
            <button class="bg-primary px-4 py-2 rounded text-white">
                Add Patient
            </button>
        </x-slot:trigger>

        <form>

            <input type="text" placeholder="Patient Name" class="w-full border rounded p-2">

            <div class="mt-4">
                <input type="email" placeholder="Email" class="w-full border rounded p-2">
            </div>

        </form>

        <x-slot:footer>

            <div class="flex justify-end gap-3">

                <button class="px-4 py-2 border rounded">
                    Cancel
                </button>

                <button class="bg-primary px-4 py-2 rounded text-white">
                    Save
                </button>

            </div>

        </x-slot:footer>

    </x-modal>

</section>
