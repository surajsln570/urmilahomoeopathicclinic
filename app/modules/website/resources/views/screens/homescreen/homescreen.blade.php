@extends('website::layouts.mainlayout')

@section('content')
    <div class="min-h-screen bg-white space-y-5 text-gray-800 font-sans">


        {{-- Hero Section --}}
        {{-- <x-website::homescreen.hero /> --}}
        <x-website::homescreen.hero :hero-images="$heroImages" />

        {{-- Video Section --}}
        {{-- <x-website::homescreen.video /> --}}

        {{-- Services --}}
        <x-website::homescreen.service :treatments="$treatments" />

        {{-- Why Choose Us --}}
        <x-website::homescreen.whychooseus />

        {{-- Testimonials --}}
        <x-website::homescreen.testimonial />

        {{-- Appointment Form --}}
        <x-website::homescreen.apointmentform />

    </div>
@endsection
