<footer class="bg-[#05262f] text-white mt-20">
    <x-website::container>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 py-12 px-6">

            <!-- Clinic Info -->
            <div>
                <h3 class="text-2xl font-bold mb-3">
                    Dr. Deepak Singh
                </h3>

                <p class="text-gray-300 mb-4">
                    Experienced Homeopathic Consultant dedicated to providing
                    safe, natural, and effective healthcare solutions.
                </p>

                <div class="space-y-2 text-gray-300">
                    <p>📍 Baraunsha, Sultanpur, Uttar Pradesh</p>

                    <a href="tel:+917307271037" class="block hover:text-emerald-400 transition">
                        📞 +91 7307271037
                    </a>

                    <a href="mailto:deepaksingh901011994@gmail.com" class="block hover:text-emerald-400 transition">
                        ✉️ deepaksingh901011994@gmail.com
                    </a>
                </div>
            </div>

            <!-- Treatments -->
            <div>
                <h3 class="text-xl font-semibold mb-4">
                    Treatments
                </h3>

                <ul class="space-y-2 text-gray-300">
                    <li>Diabetes</li>
                    <li>Asthma</li>
                    <li>Skin Disorders</li>
                    <li>Thyroid Problems</li>
                    <li>Migraine</li>
                    <li>Joint Pain</li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-semibold mb-4">
                    Quick Links
                </h3>

                <ul class="space-y-2 text-gray-300">
                    <li><a href="/" class="hover:text-emerald-400">Home</a></li>
                    <li><a href="#about" class="hover:text-emerald-400">About Doctor</a></li>
                    <li><a href="#treatments" class="hover:text-emerald-400">Treatments</a></li>
                    <li><a href="#services" class="hover:text-emerald-400">Services</a></li>
                    <li><a href="#testimonials" class="hover:text-emerald-400">Testimonials</a></li>
                    <li><a href="#contact" class="hover:text-emerald-400">Contact Us</a></li>
                </ul>
            </div>

            <!-- Appointment CTA -->
            <div>
                <h3 class="text-xl font-semibold mb-4">
                    Book Appointment
                </h3>

                <p class="text-gray-300 mb-5">
                    Schedule your consultation and start your journey toward
                    better health.
                </p>

                <a href="#contact"
                    class="inline-block bg-emerald-500 hover:bg-emerald-600 px-5 py-3 rounded-lg font-medium transition">
                    Book Now
                </a>

                <div class="flex gap-4 mt-6 text-2xl">
                    <a href="#" class="hover:text-emerald-400">📘</a>
                    <a href="#" class="hover:text-emerald-400">📷</a>
                    <a href="#" class="hover:text-emerald-400">▶️</a>
                </div>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10">
            <div class="flex flex-col md:flex-row justify-between items-center py-5 px-6 text-sm text-gray-400">

                <p>
                    © {{ now()->year }} Dr. Deepak Singh. All Rights Reserved.
                </p>

                <p>
                    Designed & Developed by Your Company
                </p>

            </div>
        </div>

    </x-website::container>
</footer>
