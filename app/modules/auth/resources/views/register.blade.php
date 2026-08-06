@extends('website::layouts.mainlayout')

@section('content')
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Create Account
            </h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                    {{-- @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror --}}
                </div>

                <!-- Mobile -->
                <div>
                    <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                    {{-- @error('mobile')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror --}}
                </div>

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

                <!-- Hidden Role -->
                <input type="hidden" name="role_id" value="4">

                <!-- Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Register
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-4">
                Already have an account?
                <a href="/login" class="text-blue-600 hover:underline">Login</a>
            </p>

        </div>

    </div>
@endsection
