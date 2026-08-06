{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head> --}}
@extends('website::layouts.mainlayout')

@section('content')
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Welcome Back
            </h2>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="/login" class="space-y-4">
                @csrf
                <!-- Email -->
                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                    {{-- @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror --}}
                </div>
                <!-- Password -->
                <div>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{-- @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror --}}
                </div>
                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="rounded">
                        <span>Remember me</span>
                    </label>

                    <a href="#" class="text-blue-600 hover:underline">
                        Forgot password?
                    </a>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Login
                </button>
            </form>
            <p class="text-center text-sm text-gray-500 mt-4">
                Don't have an account?
                <a href="/register" class="text-blue-600 hover:underline">Register</a>
            </p>
        </div>
    </div>
@endsection
