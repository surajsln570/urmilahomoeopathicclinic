<section>

    <x-website::container class="bg-background rounded-2xl">

        {{-- Heading --}}
        <x-website::typography variant="h2">
            Our Treatments
        </x-website::typography>

        <x-website::typography variant="p">
            We Specialize 100+ Ailments
        </x-website::typography>

        {{-- Grid --}}
        <div class="grid grid-cols-1 mt-10 md:grid-cols-2 lg:grid-cols-3 gap-5 place-items-center">

            @foreach ($treatments as $treatment)
                <x-website::homescreen.servicecard :treatment="$treatment" />
            @endforeach

        </div>

    </x-website::container>

</section>
