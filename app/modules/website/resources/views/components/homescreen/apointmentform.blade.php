<section id="appointment" class="w-full">
    <x-website::container class="bg-gradient-to-r rounded-xl from-background1 to-white">
        <div class="flex justify-center p-5 w-full lg:mb-20">
            <div x-data="{
                fullName: '',
                mobileNumber: '',
                submit() {
                    console.log(this.fullName, this.mobileNumber);
                }
            }" class="p-5 w-full xl:p-10 bg-white rounded-2xl relative gap-2 flex flex-col">
                <x-website::typography variant="h2">
                    Start Your Natural Healing Journey Today
                </x-website::typography>
                <x-website::typography variant="p">
                    Book your consultation now and get personalized homeopathic treatment from experienced
                    professionals.
                </x-website::typography>
                <form class="mt-5 w-full" @submit.prevent="submit">
                    <div class="grid grid-cols-1 lg:grid-cols-3 place-items-end gap-2">
                        <x-website::input label="Email Address" type="email" name="email"
                            placeholder="john@example.com" required />
                        <x-website::input label="Password" type="text" name="password" placeholder="******"
                            required />
                        {{-- Submit Button --}}
                        <div class="lg:mt-0 mt-5">
                            <x-website::button type="submit" variant="primary" class="w-full">
                                Book Appointment
                            </x-website::button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-website::container>
</section>
