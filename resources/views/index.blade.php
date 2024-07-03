<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Agung Al Azhar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .hidden {
            display: none;
        }
    </style>

</head>

<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="bg-white text-white p-4">
        <div class="flex justify-between items-center">
            <img src="img/logo.png" alt="Masjid Logo" class="h-12">
            <div class="text-center">
                <h1 class="text-xl font-bold text-black">Masjid Agung Al Azhar</h1>
                <p class="text-sm text-black">Masjid for Educational and Cultural Movement</p>
            </div>
            <button class="text-black text-2xl">
                <i class="fa-solid fa-bell"></i>
            </button>
        </div>
    </header>

    <!-- Hero -->
    <section id="main" class="relative bg-blue-500 pt-2">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('thumbnail/thumbnail-1.png') }}" alt="Masjid Image"
                        class="w-full h-64 object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('thumbnail/thumbnail-2.png') }}" alt="Masjid Image"
                        class="w-full h-64 object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('thumbnail/thumbnail-3.png') }}" alt="Masjid Image"
                        class="w-full h-64 object-cover">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('thumbnail/thumbnail-4.png') }}" alt="Masjid Image"
                        class="w-full h-64 object-cover">
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Nav Icon -->
    <section id="navigation" class="grid grid-cols-3 gap-4 py-4 px-4">
        <div class="bg-white rounded-lg shadow-md p-4 text-center flex flex-col items-center">
            <img src="img/profile.png" class="w-16 mb-2" alt="">
            <p class="font-bold">Profile</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center flex flex-col items-center">
            <img src="img/calender.png" class="w-16 mb-2" alt="">
            <p class="font-bold">Giat Masjid</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center flex flex-col items-center">
            <img src="img/tv.png" class="w-16 mb-2" alt="">
            <p class="font-bold">MAA TV</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center flex flex-col items-center">
            <img src="img/buletin.png" class="w-16 mb-2" alt="">
            <p class="font-bold">Buletin</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center flex flex-col items-center">
            <img src="img/konsultasi.png" class="w-16 mb-2" alt="">
            <p class="font-bold">Konsultasi</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 text-center flex flex-col items-center">
            <img src="img/saran.png" class="w-16 mb-2" alt="">
            <p class="font-bold">Saran</p>
        </div>
    </section>


    <!-- Tabs News -->
    <section id="tabs" class="my-4">
        <div class="flex justify-start bg-gray-200 p-2 rounded-md space-x-4">
            <button id="tab-terbaru" class="bg-blue-500 text-white px-4 py-2 rounded-md"
                onclick="openTab('terbaru')">Terbaru</button>
            <button id="tab-cahaya" class="text-gray-600 px-4 py-2 rounded-md" onclick="openTab('cahaya')">Cahaya Al
                Quran</button>
            <button id="tab-donasi" class="text-gray-600 px-4 py-2 rounded-md"
                onclick="openTab('donasi')">Donasi</button>
        </div>
    </section>

    <!-- Content Section -->
    <section id="content-terbaru" class="p-4">
        <div class="bg-white p-4 rounded-md shadow-md mb-4">
            <div class="flex">
                <img src="https://placehold.co/200" alt="News Image" class="w-20 h-20 mr-4">
                <div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <p class="text-sm text-gray-500">27 June 2024 11:09</p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button id="view-content-terbaru" class="bg-blue-500 text-white mt-5 px-4 py-2 rounded-md">View All</button>
        </div>
    </section>

    <section id="content-cahaya" class="p-4 hidden">
        <div class="bg-white p-4 rounded-md shadow-md mb-4">
            <div class="flex">
                <img src="https://placehold.co/200" alt="News Image" class="w-20 h-20 mr-4">
                <div>
                    <p>Cahaya Al Quran goes here.</p>
                    <p class="text-sm text-gray-500">27 June 2024 11:09</p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button id="view-content-cahaya" class="bg-red-500 text-white mt-5 px-4 py-2 rounded-md">View All</button>
        </div>
    </section>

    <section id="content-donasi" class="p-4 hidden">
        <div class="bg-white p-4 rounded-md shadow-md mb-4">
            <div class="flex">
                <img src="https://placehold.co/200" alt="News Image" class="w-20 h-20 mr-4">
                <div>
                    <p>Donasi goes here.</p>
                    <p class="text-sm text-gray-500">27 June 2024 11:09</p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button id="view-content-donasi" class="bg-green-500 text-white mt-5 px-4 py-2 rounded-md">View
                All</button>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="py-20 bg-white">
        <h3 class="text-5xl font-bold text-center mb-5">Services</h3>
        <p class="text-gray-500 mb-5 text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet,
            reprehenderit?</p>
        <div class="grid grid-cols-2 md:grid-cols-4 w-11/12 md:container mx-auto gap-6">
            <!-- Portfolio 1 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Services 1</h4>
                    </div>
                </a>
            </div>
            <!-- Portfolio 2 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Services 2</h4>
                    </div>
                </a>
            </div>
            <!-- Portfolio 3 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Services 3</h4>
                    </div>
                </a>
            </div>
            <!-- Portfolio 4 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Services 4</h4>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Bottom Nav -->
    <footer class="fixed bottom-0 left-0 w-full bg-white shadow-md shadow-top">
        <div class="flex justify-around p-2">
            <a href="#" class="text-center">
                <i class="fa-solid fa-house"></i>
                <p>Beranda</p>
            </a>
            <a href="#" class="text-center">
                <i class="fa-solid fa-newspaper"></i>
                <p>Artikel</p>
            </a>
            <a href="#" class="text-center">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <p>Donasi</p>
            </a>
            <a href="#" class="text-center">
                <i class="fa-solid fa-gear"></i>
                <p>Akun</p>
            </a>
        </div>
    </footer>
    <!-- JavaScript -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/custom-script.js') }}"></script>
</body>

</html>
