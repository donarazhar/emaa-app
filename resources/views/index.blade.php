<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App Blog</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Swiper.js CDN -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

</head>

<body class="bg-white">

    <!-- Navbar -->
    <nav class="bg-blue-900 shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center z-50">
            <div class="text-xl font-bold text-white">MyBlog</div>
            <div class="hidden md:flex space-x-4">
                <a href="#beranda" class="text-white hover:text-red-400 px-3 py-2 rounded">Beranda</a>
                <a href="#fitur" class="text-white hover:text-red-400 px-3 py-2 rounded">Fitur</a>
                <a href="#blog" class="text-white hover:text-red-400 px-3 py-2 rounded">Blog</a>
                <a href="#login" class="text-white hover:text-red-400 px-3 py-2 rounded">Login</a>
            </div>
            <div class="md:hidden flex items-center">
                <button class="text-white focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Bottom Navbar -->
    <nav class="fixed bottom-2 left-10 right-10 bg-blue-900 shadow-t-md md:hidden z-50 rounded-xl">
        <div class="flex justify-around">
            <a href="#beranda" class="text-white hover:text-red-400 p-5 flex flex-col items-center">
                <i class="fas fa-home fa-lg mb-2.5"></i>
                <span class="block text-xs">Beranda</span>
            </a>
            <a href="#fitur" class="text-white hover:text-red-400 p-5 flex flex-col items-center">
                <i class="fas fa-book fa-lg mb-2.5"></i>
                <span class="block text-xs">Fitur</span>
            </a>
            <a href="#blog" class="text-white hover:text-red-400 p-5 flex flex-col items-center">
                <i class="fas fa-blog fa-lg mb-2.5"></i>
                <span class="block text-xs">Blog</span>
            </a>
            <a href="#login" class="text-white hover:text-red-400 p-5 flex flex-col items-center">
                <i class="fas fa-sign-in-alt fa-lg mb-2.5"></i>
                <span class="block text-xs">Login</span>
            </a>
        </div>
    </nav>


    <!-- Hero Section -->
    <div class="relative isolate overflow-hidden pt-14 bg-blue-900">
        <img src="https://asset-2.tstatic.net/bekasi/foto/bank/images/Masjid-Agung-Al-Azhar.jpg" alt=""
            class="absolute inset-0 -z-10 h-full w-full object-cover opacity-5">

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="container mx-auto py-10 flex flex-col sm:flex-row items-center">
                        <div class="text-left sm:w-1/2 px-4">
                            <h1 class="text-4xl font-bold text-white sm:text-6xl">Data to enrich your online business
                            </h1>
                            <p class="mt-6 text-lg text-gray-300">Anim aute id magna aliqua ad ad non deserunt sunt. Qui
                                irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.
                            </p>
                            <div class="mt-10 flex gap-x-6 items-center">
                                <a href="#"
                                    class="bg-red-500 px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-900">Get
                                    started</a>
                                <a href="#" class="text-sm font-semibold text-white">Learn more →</a>
                            </div>
                        </div>
                        <div class="sm:w-1/2 px-4">
                            <img src="https://masjidagungalazhar.com/assets/images/ilustrasi.png" alt="Hero Image"
                                class="w-full h-auto">
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="container mx-auto py-10 flex flex-col sm:flex-row items-center">
                        <div class="text-left sm:w-1/2 px-4">
                            <h1 class="text-4xl font-bold text-white sm:text-6xl">Second Hero Title</h1>
                            <p class="mt-6 text-lg text-gray-300">Another description for the second hero slide.
                                Highlighting different aspects of the service.</p>
                            <div class="mt-10 flex gap-x-6 items-center">
                                <a href="#"
                                    class="bg-red-500 px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-900">Get
                                    started</a>
                                <a href="#" class="text-sm font-semibold text-white">Learn more →</a>
                            </div>
                        </div>
                        <div class="sm:w-1/2 px-4">
                            <img src="https://masjidagungalazhar.com/assets/images/ilustrasi.png" alt="Hero Image"
                                class="w-full h-auto">
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="container mx-auto py-10 flex flex-col sm:flex-row items-center">
                        <div class="text-left sm:w-1/2 px-4">
                            <h1 class="text-4xl font-bold text-white sm:text-6xl">Third Hero Title</h1>
                            <p class="mt-6 text-lg text-gray-300">Description for the third hero slide. Showcasing
                                another unique feature or benefit.</p>
                            <div class="mt-10 flex gap-x-6 items-center">
                                <a href="#"
                                    class="bg-red-500 px-3.5 py-2.5 text-sm font-semibold text-white hover:bg-blue-900">Get
                                    started</a>
                                <a href="#" class="text-sm font-semibold text-white">Learn more →</a>
                            </div>
                        </div>
                        <div class="sm:w-1/2 px-4">
                            <img src="https://masjidagungalazhar.com/assets/images/ilustrasi.png" alt="Hero Image"
                                class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Fitur Section -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-6 lg:px-8 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/3 mb-10 lg:mb-0">
                <img src="https://masjidagungalazhar.com/assets/images/about-left-image.png" alt="Fitur Image"
                    class="w-auto h-auto hidden lg:block">
            </div>
            <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                <div
                    class="flex items-start bg-gradient-to-r from-red-700 to-red-500 rounded-lg p-4 lg:flex lg:items-start lg:bg-white lg:p-4">
                    <img src="https://masjidagungalazhar.com/assets/images/service-icon-01.png" alt=""
                        class="h-24 w-24 mr-4 lg:h-32 lg:w-32 lg:mr-4">
                    <div>
                        <h3 class="text-xl font-bold text-white lg:text-black">Media Silaturahmi</h3>
                        <p class="text-white lg:text-black">Jalin silaturahmi dengan Fitur Profile, Giat Masjid,
                            Konsultasi dan Saran...</p>
                    </div>
                </div>
                <div
                    class="flex items-start bg-gradient-to-r from-red-700 to-red-500 rounded-lg p-4 lg:flex lg:items-start lg:bg-white lg:p-4">
                    <img src="https://masjidagungalazhar.com/assets/images/service-icon-02.png" alt=""
                        class="h-24 w-24 mr-4 lg:h-32 lg:w-32 lg:mr-4">
                    <div>
                        <h3 class="text-xl font-bold text-white lg:text-black">Media Donasi</h3>
                        <p class="text-white lg:text-black">Fitur Donasi yang dapat dilakukan dengan Donasi Online,
                            Amal Usaha dan QRIS...</p>
                    </div>
                </div>
                <div
                    class="flex items-start bg-gradient-to-r from-red-700 to-red-500 rounded-lg p-4 lg:flex lg:items-start lg:bg-white lg:p-4">
                    <img src="https://masjidagungalazhar.com/assets/images/service-icon-03.png" alt=""
                        class="h-24 w-24 mr-4 lg:h-32 lg:w-32 lg:mr-4">
                    <div>
                        <h3 class="text-xl font-bold text-white lg:text-black">Media Belajar</h3>
                        <p class="text-white lg:text-black">Belajar lebih dalam mengenai Islam melalui Fitur MAA TV dan
                            Buletin...</p>
                    </div>
                </div>
                <div
                    class="flex items-start bg-gradient-to-r from-red-700 to-red-500 rounded-lg p-4 lg:flex lg:items-start lg:bg-white lg:p-4">
                    <img src="https://masjidagungalazhar.com/assets/images/service-icon-04.png" alt=""
                        class="h-24 w-24 mr-4 lg:h-32 lg:w-32 lg:mr-4">
                    <div>
                        <h3 class="text-xl font-bold text-white lg:text-black">Notifikasi</h3>
                        <p class="text-white lg:text-black">Dapatkan berita-berita terupdate melalui notifikasi yang
                            kami kirim..</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

</body>

</html>
