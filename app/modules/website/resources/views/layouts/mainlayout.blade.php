<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urmila Homeopathic Clinic</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-900">
    <x-website::nav />
    <main class="pt-[100px] w-full mx-auto min-h-screen">
        @yield('content')
    </main>
    <x-website::footer />
</body>

</html>
