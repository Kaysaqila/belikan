<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link rel="icon" href="{{ asset('images/icon.png') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />


        <div class="min-h-screen bg-white text-gray-800 antialiased">
            <!-- Sticky & Transparent Navbar -->
            <div class="sticky top-0 z-50 bg-white/30 backdrop-blur-md">
                @livewire('navigation-menu')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
                   <div id="cart-popup"
                    style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999; background:rgba(0,0,0,0.2);"
                    class="flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-lg px-8 py-6 flex flex-col items-center transition-opacity duration-300 ease-in-out opacity-0 transform -translate-y-4"
                        id="cart-popup-content">
                        <!-- Checklist hijau SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-green-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <circle cx="12" cy="12" r="10" fill="#22c55e" />
                            <path stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12l2.5 2.5L16 9" />
                        </svg>
                        <span class="text-lg font-semibold text-gray-800">Berhasil ditambahkan ke keranjang!</span>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        window.addEventListener('product-added-to-cart', function(event) {
                            const popup = document.getElementById('cart-popup');
                            const content = document.getElementById('cart-popup-content');
                            if (!popup || !content) return;

                            // Tampilkan popup
                            popup.style.display = 'flex';

                            // Animasi masuk
                            setTimeout(() => {
                                content.classList.remove('opacity-0', '-translate-y-4');
                                content.classList.add('opacity-100', 'translate-y-0');
                            }, 10);

                            // Sembunyikan popup setelah 2 detik
                            setTimeout(() => {
                                content.classList.add('opacity-0', '-translate-y-4');
                                content.classList.remove('opacity-100', 'translate-y-0');
                                setTimeout(() => {
                                    popup.style.display = 'none';
                                }, 300); // waktu animasi keluar
                            }, 1000);
                        });
                    });
                </script>
            </main>
        </div>


        @stack('modals')

        @livewireScripts
        
 
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</html>
