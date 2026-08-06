@extends('dashboard::layouts.dashboardLayout')
@section('page-title', 'Hero Images')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Hero Images
            </h1>
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <form action="{{ route('heroimage.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Hero Image</label>
                        <input type="file" name="hero_images" accept="image/*" required
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Upload Hero Image
                    </button>

                </form>
            </div>
        </div>
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="flex flex-col gap-5">
            @forelse ($heroImages as $hero)
                <div class="flex justify-between shadow-lg shadow-gray-300 p-2 rounded-lg w-full items-center">
                    <img src="{{ asset($hero->heroimage) }}" alt="Hero Image"
                        class="w-30 h-20 object-cover rounded-lg border">
                    <div>{{ $hero->created_at->format('d M Y') }}</div>
                    <div class="flex w-[20%] justify-between items-center">
                        <form action="{{ route('hero-images.destroy', $hero->id) }}" method="POST"
                            onsubmit="return confirm('Delete this hero image?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                                Delete
                            </button>
                        </form>
                        <form action="{{ route('hero-images.status', $hero->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <button type="submit"
                                class="{{ !$hero->status ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} text-white px-3 py-2 rounded">
                                @if ($hero->status)
                                    Deactivate
                                @else
                                    Activate
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    No Hero Images Found
                </div>
            @endforelse
        </div>

    </div>
@endsection
