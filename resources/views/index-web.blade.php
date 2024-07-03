<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Masjid Agung Al Azhar - Masjid for Educational & Cultural Movement</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-100">

    <!-- Header -->

    {{-- Top Navbar --}}
    <header class="bg-white fixed w-full top-0 shadow z-50">
        <div class="container mx-auto px-5 py-1">
            <div class="flex items-center justify-between">
                <img src="https://placehold.co/100" alt="" class="rounded-3xl">
                <nav class="hidden md:flex space-x-5">
                    <a href="/" class="mt-2 text-gray-500 hover:text-red-500">Beranda</a>
                    <a href="#features" class="mt-2 text-gray-500 hover:text-red-500">Fitur</a>
                    <a href="#donation" class="mt-2 text-gray-500 hover:text-red-500">Rekening</a>
                    <a href="#services" class="mt-2 text-gray-500 hover:text-red-500">Layanan</a>
                    <a href="#download" class="mt-2 text-gray-500 hover:text-red-500">Download</a>
                    <a href="#" class="mt-2 text-gray-500 hover:text-red-500">Donasi Online</a>
                    <a href="#" class="bg-red-500 text-white px-7 py-3 rounded-lg hover:bg-blue-500">Subscribe</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Bottom Nav -->
    <nav
        class="mobile-nav flex justify-around md:hidden bg-white fixed bottom-0 left-0 right-0 mx-auto max-w-xl rounded-t-xl">
        <a href="#" class="text-center group">
            <div class="icon-wrapper relative rounded-full p-2">
                <i id="icon1"
                    class="fa-solid fa-house text-xl text-blue-500 transition duration-300 group-hover:text-red-500"
                    onclick="change(this)" style="font-size: 1.5rem;"></i>
                <p class="text-sm mt-2">Beranda</p>
            </div>
        </a>
        <a href="#features" class="text-center group">
            <div class="icon-wrapper relative rounded-full p-2">
                <i id="icon2"
                    class="fa-solid fa-newspaper text-xl text-blue-500 transition duration-300 group-hover:text-red-500"
                    onclick="change(this)" style="font-size: 1.5rem;"></i>
                <p class="text-sm mt-2">Fitur</p>
            </div>
        </a>
        <a href="#donation" class="text-centerc relative -top-4 group">
            <div class="icon-wrapper relative bg-white rounded-full p-2">
                <i id="icon3"
                    class="fa-solid fa-circle-dollar-to-slot text-5xl text-blue-500 transition duration-300 group-hover:text-red-500"
                    onclick="change(this)" style="font-size: 2rem;"></i>
                <p class="text-sm mt-2">Rekening</p>
            </div>
        </a>
        <a href="#services" class="text-center group">
            <div class="icon-wrapper relative rounded-full p-2">
                <i id="icon4"
                    class="fa-brands fa-slack text-xl text-blue-500 transition duration-300 group-hover:text-red-500"
                    onclick="change(this)" style="font-size: 1.5rem;"></i>
                <p class="text-sm mt-2">Layanan</p>
            </div>
        </a>
        <a href="#" class="text-center group">
            <div class="icon-wrapper relative rounded-full p-2">
                <i id="icon5"
                    class="fa-solid fa-gift text-xl text-blue-500 transition duration-300 group-hover:text-red-500"
                    onclick="change(this)" style="font-size: 1.5rem;"></i>
                <p class="text-sm mt-2">Donasi</p>
            </div>
        </a>
    </nav>

    <div class="mt-28"></div> <!-- Spacer to avoid content overlay -->

    <!-- Hero Section -->
    <section id="hero" class="relative">
        <div class="container-fluid bg-white px-20 pt-10 grid grid-cols-1 md:grid-cols-2 items-center">
            <div class="text-center md:text-left mb-5">
                <p class="text-gray-600 mb-2">Assalamualaikum Warrahmatullahi Wabarakatuh.</p>
                <h1 class="text-4xl md:text-6xl font-bold mb-5 leading-tight md:leading-tight">
                    Satu Aplikasi <span class="text-blue-500">untuk</span> GEMILANG
                    <br class="hidden md:inline">
                    <span class="text-blue-500">Masjidku</span>
                </h1>
                <p class="text-gray-600 mb-8">Aplikasi Masjid Agung Al Azhar berbasis mobile sebagai Media Silaturahmi,
                    Media Belajar, dan Media Donasi bagi Jamaah.</p>
                <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-full mb-5">Selengkapnya...</a>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="https://placehold.co/400" alt="Aplikasi" class="max-w-full rounded-3xl">
            </div>
        </div>
        <!-- Wave SVG -->
        <div class="absolute bottom left-0 right-0 overflow-hidden leading-[0]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1"
                    d="M0,224L60,186.7C120,149,240,75,360,42.7C480,11,600,21,720,58.7C840,96,960,160,1080,170.7C1200,181,1320,139,1380,117.3L1440,96L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-blue-600 py-20">
        <div class="container-fluid mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Gambar -->
            <div class="flex justify-center md:justify-start z-0">
                <img src="https://placehold.co/400" alt="Features" class="max-w-full rounded-3xl">
            </div>
            <!-- Teks Fitur -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 -z-0">
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">Lorem, ipsum.</h2>
                    <p class="text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis,
                        itaque!</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">Lorem, ipsum.</h2>
                    <p class="text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis,
                        itaque!</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">Lorem, ipsum.</h2>
                    <p class="text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis,
                        itaque!</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">Lorem, ipsum.</h2>
                    <p class="text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis,
                        itaque!/p>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Section -->
    <section id="donation" class="relative">
        <div class="container-fluid bg-white mx-auto px-20 py-20 text-center border">
            <h2 class="text-3xl font-bold mb-8">Salurkan <span class="text-blue-500">Donasi Anda Melalui
                    Rekening</span>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="BNI Syariah" class="mx-auto mb-4">
                    <p class="text-gray-600">BNI Syariah</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="Mandiri Syariah" class="mx-auto mb-4">
                    <p class="text-gray-600">Mandiri Syariah</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="BTN Syariah" class="mx-auto mb-4">
                    <p class="text-gray-600">BTN Syariah</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="Bank Muamalat" class="mx-auto mb-4">
                    <p class="text-gray-600">Bank Muamalat</p>
                </div>
                <!-- Card 5 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="Mandiri" class="mx-auto mb-4">
                    <p class="text-gray-600">Mandiri</p>
                </div>
                <!-- Card 6 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="BNI" class="mx-auto mb-4">
                    <p class="text-gray-600">BNI</p>
                </div>
                <!-- Card 7 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="BSI" class="mx-auto mb-4">
                    <p class="text-gray-600">BSI</p>
                </div>
                <!-- Card 8 -->
                <div class="bg-white p-6 rounded shadow">
                    <img src="https://placehold.co/100" alt="BSI" class="mx-auto mb-4">
                    <p class="text-gray-600">BSI</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="bg-gray-100 py-20">
        <div class="container mx-auto px-6">

            <h2 class="text-5xl font-bold text-center mb-8">Layanan <span class="text-blue-500">Terbaik</span> Yang
                Selalu Kami <span class="text-red-500">Berikan</span>.</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kiri: Gambar dengan Kartu -->
                <div class="relative col-span-1 lg:col-span-2">
                    <img src="https://placehold.co/100" alt="Kantor Kami"
                        class="w-full h-3/4 object-cover rounded-3xl">
                    <div
                        class="absolute left-0 bottom-[220px] mx-auto w-4/5 bg-white p-6 rounded-3xl shadow-lg transform translate-y-1/2">
                        <h3 class="text-xl font-bold mt-5 mb-5">Kantor Kami</h3>
                        <p class="text-gray-600 mb-4">Jl. Sisingamangaraja, Kebayoran Baru, Jakarta Selatan 12110,
                            Telp.(021) 727 83683 / 739 7267</p>
                    </div>
                    <div class="absolute left-0 bottom-[50px] mx-auto pl-6">
                        <a href="https://placehold.co/100"
                            class="text-white bg-blue-500 hover:bg-blue-600 px-5 py-4 rounded-3xl shadow-2xl">Cari Di
                            Google
                            Maps</a>
                    </div>
                </div>


                <!-- Kanan: Tiga Kartu dalam Satu Kolom -->
                <div class="space-y-4">
                    <div class="bg-white p-6 rounded shadow">
                        <img src="https://placehold.co/100" alt="Aula Buya Hamka"
                            class="mb-4 w-full h-40 object-cover rounded">
                        <h3 class="text-xl font-bold mb-2">Aula Buya Hamka</h3>
                        <p class="text-gray-600 mb-4">Aula serba guna yang dapat digunakan untuk acara yang
                            direncanakan...</p>
                    </div>
                    <div class="bg-white p-6 rounded shadow">
                        <img src="https://placehold.co/100" alt="Amal Usaha"
                            class="mb-4 w-full h-40 object-cover rounded">
                        <h3 class="text-xl font-bold mb-2">Amal Usaha</h3>
                        <p class="text-gray-600 mb-4">Toko online Masjid Agung Al Azhar di Shopee dan Tokopedia...</p>
                    </div>
                    <div class="bg-white p-6 rounded shadow">
                        <img src="https://placehold.co/100" alt="Konsultasi & Pengislaman"
                            class="mb-4 w-full h-40 object-cover rounded">
                        <h3 class="text-xl font-bold mb-2">Konsultasi & Pengislaman</h3>
                        <p class="text-gray-600 mb-4">Konsultasikan masalah anda ke Masjid Agung Al Azhar...</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Download Section -->
    <section id="download" class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Kiri: Teks dan Tombol -->
            <div class="text-center md:text-left">
                <h2 class="text-4xl leading-tight font-bold mb-8">Unduh Dan Hadirkan Masjid Agung Al Azhar Di Genggaman
                    Anda</h2>
                <img src="https://placehold.co/600x200" alt="Google Play" class="max-w-full rounded-3xl">
            </div>
            <!-- Kanan: Gambar -->
            <div class="flex justify-center md:justify-end">
                <img src="https://placehold.co/400" alt="Aplikasi" class="max-w-full rounded-3xl">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="container-fluid text-sm bg-white text-black text-center py-5 mb-20 md:mb-0">
        <p>Masjid Agung Al Azhar | Epicentrum Dakwah dan Sosial | All rights reserved.</p>
        <p>Design by Staf ICT MAA | &copy; Copyright 2024</p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
