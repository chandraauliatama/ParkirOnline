<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Parkir Online') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login_img_section {
            background: #0055b3;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="flex h-screen">
        <div class="login_img_section hidden w-full items-center justify-around lg:flex lg:w-1/2">
            <div class="inset-0 z-0 bg-black opacity-20"></div>
            <div class="mx-auto w-full flex-col items-center space-y-6 px-20">

                {{ $image }}

                <p class="mt-1 font-bold text-white">Gunakan Aplikasi Parkir Ini Untuk Memudahkan Parkirmu!!</p>
                <div class="mt-6 flex justify-center lg:justify-start">
                    <a href="{{ route('dashboard') }}"
                       class="hover:bg-[#79c39b]hover:text-white mt-4 mb-2 rounded-2xl bg-white px-4 py-2 font-bold text-blue-500 transition-all duration-500 hover:-translate-y-1">
                        Get Started
                    </a>
                </div>
            </div>
        </div>

        {{ $slot }}

    </div>
    @vite(['resources/js/app.js'])
</body>

</html>
