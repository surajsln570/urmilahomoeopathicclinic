<section class="w-full bg-gradient-to-r from-bg-sidebar-tint bg-background2">

    <x-website::container>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 place-items-center">

            {{-- Image --}}
            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=1200&auto=format&fit=crop"
                alt="Clinic" class="rounded-lg object-cover h-[500px] w-full" />

            {{-- Content --}}
            <div class="w-full flex flex-col">
                <x-website::typography variant="p">
                    Why Choose Us
                </x-website::typography>
                <x-website::typography variant="h2" class="text-success">
                    Complete Holistic Care For Your Health
                </x-website::typography>
                <p class="mt-6 text-gray-700">
                    We believe in treating the root cause of illness rather than only managing symptoms.
                    Our approach combines personalized consultation and gentle remedies.
                </p>
                @php
                    $features = [
                        'Experienced & Certified Homeopathic Doctor',
                        'Personalized Treatment Plans',
                        'Natural & Safe Medicines',
                        'Online & Offline Consultation Available',
                    ];
                @endphp

                <div class="space-y-6 w-full mt-10">

                    @foreach ($features as $item)
                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">
                                ✓
                            </div>

                            <p class="font-medium text-gray-700">
                                {{ $item }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-website::container>
</section>
