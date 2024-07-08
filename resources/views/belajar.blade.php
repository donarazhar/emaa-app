<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple TailwindCSS Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .mobile-menu {
            display: none;
        }

        .mobile-menu.show {
            display: block;
        }
    </style>
</head>

<body class="bg-blue-900 text-white">
    <header class="fixed w-full top-0 z-50 p-6 flex items-center justify-between bg-blue-900">
        <a href="#" class="flex items-center space-x-2">
            <img class="h-8 w-auto" src="https://masjidagungalazhar.com/assets/images/logo.png" alt="Your Company">
            <span class="sr-only">Your Company</span>
        </a>
        <div class="lg:hidden">
            <button id="mobile-menu-button" class="text-blue-400">
                <span class="sr-only">Open main menu</span>
                <i class="fas fa-bars h-6 w-6"></i>
            </button>
        </div>
        <nav class="hidden lg:flex space-x-6">
            <a href="#" class="text-white">Product</a>
            <a href="#" class="text-white">Features</a>
            <a href="#" class="text-white">Marketplace</a>
            <a href="#" class="text-white">Company</a>
            <a href="#" class="text-white">Log in &rarr;</a>
        </nav>
    </header>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="mobile-menu lg:hidden fixed inset-0 z-50 bg-blue-900 p-6 space-y-6">
        <div class="flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img class="h-8 w-auto" src="https://masjidagungalazhar.com/assets/images/logo.png" alt="Your Company">
                <span class="sr-only">Your Company</span>
            </a>
            <button id="close-mobile-menu-button" class="text-blue-400">
                <span class="sr-only">Close menu</span>
                <i class="fas fa-times h-6 w-6"></i>
            </button>
        </div>
        <nav class="space-y-4">
            <a href="#" class="block text-white">Product</a>
            <a href="#" class="block text-white">Features</a>
            <a href="#" class="block text-white">Marketplace</a>
            <a href="#" class="block text-white">Company</a>
            <a href="#" class="block text-white">Log in</a>
        </nav>
    </div>

    <div class="relative overflow-hidden pt-20">
        <img src="https://cdn1-production-images-kly.akamaized.net/4c8xpICyqCv3w4_SPJ2R711QxEA=/1280x720/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3081758/original/018138000_1584692957-20200320-Suasana-Salat-Jumat-di--Masjid-Agung-Al-Azhar-Jakarta-5.jpg"
            alt="" class="absolute inset-0 h-full w-full object-cover opacity-10">
        <div class="mx-auto max-w-2xl py-32 text-center">
            <h1 class="text-4xl font-bold sm:text-6xl">Data to enrich your online business</h1>
            <p class="mt-6 text-lg text-blue-300">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem
                cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
            <div class="mt-10 flex justify-center space-x-4">
                <a href="#" class="bg-indigo-500 text-white py-2 px-4 rounded-md">Get started</a>
                <a href="#" class="text-white">Learn more &rarr;</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('show');
        });

        document.getElementById('close-mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.remove('show');
        });
    </script>
</body>

</html>
