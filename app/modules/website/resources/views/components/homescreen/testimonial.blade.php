<section>

    <x-website::container>

        <div class="w-full">

            <x-website::typography variant="p">
                TESTIMONIALS
            </x-website::typography>

            <x-website::typography variant="h2">
                What Our Patients Say
            </x-website::typography>

            @php
                $testimonies = [
                    [
                        'name' => 'Ramesh Yadav',
                        'location' => 'Varanasi, Uttar Pradesh',
                        'rating' => 5,
                        'content' =>
                            'I was suffering from diabetes for many years. After treatment and guidance, my sugar levels became much more stable. The doctors were very supportive and caring.',
                        'image' => 'https://randomuser.me/api/portraits/men/32.jpg',
                    ],
                    [
                        'name' => 'Sunita Sharma',
                        'location' => 'Lucknow, Uttar Pradesh',
                        'rating' => 5,
                        'content' =>
                            'I visited for hypertension treatment. The staff explained everything clearly and my blood pressure is now under control. Very satisfied with the service.',
                        'image' => 'https://randomuser.me/api/portraits/women/44.jpg',
                    ],
                    [
                        'name' => 'Amit Verma',
                        'location' => 'Prayagraj, Uttar Pradesh',
                        'rating' => 4,
                        'content' =>
                            'The doctors helped me recover from severe asthma problems. The environment was clean and appointments were well managed.',
                        'image' => 'https://randomuser.me/api/portraits/men/51.jpg',
                    ],
                    [
                        'name' => 'Pooja Singh',
                        'location' => 'Kanpur, Uttar Pradesh',
                        'rating' => 5,
                        'content' =>
                            'I received treatment for migraine issues. The medicines and lifestyle guidance worked really well. I feel much healthier now.',
                        'image' => 'https://randomuser.me/api/portraits/women/68.jpg',
                    ],
                    [
                        'name' => 'Vikash Patel',
                        'location' => 'Gorakhpur, Uttar Pradesh',
                        'rating' => 5,
                        'content' =>
                            'Very professional doctors and friendly staff. My thyroid condition improved significantly after regular treatment here.',
                        'image' => 'https://randomuser.me/api/portraits/men/75.jpg',
                    ],
                    [
                        'name' => 'Neha Mishra',
                        'location' => 'Ayodhya, Uttar Pradesh',
                        'rating' => 4,
                        'content' =>
                            'The hospital provided excellent care during my PCOS treatment. The doctors listened patiently and guided me properly.',
                        'image' => 'https://randomuser.me/api/portraits/women/24.jpg',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 w-full mt-5">

                @foreach ($testimonies as $testimony)
                    <x-website::homescreen.testimonialcard :testimony="$testimony" />
                @endforeach

            </div>

        </div>

    </x-website::container>

</section>
