<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Masjid Agung Al Azhar with Tailwindcss</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <!-- Header  Navbar-->
    <header class="bg-blue-900 sticky top-0">
        <nav class="w-11/12 md:container mx-auto py-4 flex justify-between items-center text-white">
            <a href="#" class="text-3xl font-bold">
                <img class="h-10 w-10" src="{{ asset('img/logomaa.png') }}" alt=""></a>
            <ul
                class="menu hidden md:flex bg-blue-900 mt-4 md:bg-blue-900 md:relative md:top-0 md:divide-y-0 md:w-auto">
                <li class="px-4 py-2 hover:text-white hover:bg-red-500 hover:rounded-lg"><a href="#hero">Beranda</a>
                </li>
                <li class="px-4 py-2 hover:text-white hover:bg-red-500 hover:rounded-lg"><a href="#fitur">Fitur</a>
                </li>
                <li class="px-4 py-2 hover:text-white hover:bg-red-500 hover:rounded-lg"><a
                        href="#rekening">Rekening</a>
                </li>
                <li class="px-4 py-2 hover:text-white hover:bg-red-500 hover:rounded-lg"><a href="#layanan">Layanan</a>
                </li>
                <li class="px-4 py-2 hover:text-white hover:bg-red-500 hover:rounded-lg"><a href="#about">Download</a>
                </li>
                <li class="px-4 py-2 hover:text-white hover:bg-red-500 hover:rounded-lg"><a href="#about">Donasi
                        Online</a></li>
                <li
                    class="px-4 py-2 hover:text-white hover:bg-red-500 md:hover:bg-blue-900 md:hover:text-white hover:rounded-lg ">
                    <a href="#"
                        class="md:border-2 md:bg-red-500 md:py-2 md:px-6 md:rounded-xl md:hover:bg-blue-900 text-white">Info
                        MAA</a>
                </li>
            </ul>
            <button class="hamburger-menu text-2xl md:hidden">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark hidden"></i>
            </button>
        </nav>
    </header>

    <!-- Hero -->
    <section id="hero" class="bg-blue-900">
        <div class="container mx-auto text-center text-white h-screen grid grid-cols-1 md:grid-cols-2 items-center">
            <div class="mx-auto w-3/4 md:w-3/4">
                <p class="text-white mb-5 text-sm font-italic">Assalamualaikum Warrahmatullahi Wabarakatuh.</p>
                <h3 class="text-5xl font-bold text-center mb-5"><span class="text-red-500">Satu Aplikasi</span>
                    untuk GEMILANG <span class="text-red-500">Masjidku</span></h3>
                <p class="text-white mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam non
                    nihil ratione eveniet assumenda facilis.</p>
                <a href="#portofolio"
                    class="bg-red-500 text-white py-2 px-8 rounded-xl hover:bg-blue-900 hover:border-2">Selengkapnya...</a>
            </div>
            <div class="mx-auto hidden md:block md:w-auto">
                <img src="{{ asset('hero/maa.png') }}" alt="">
            </div>
        </div>
    </section>

    <!-- Fitur -->
    <section id="fitur" class="bg-white py-20 md:py-32">
        <h3 class="text-4xl md:text-5xl font-bold text-center mb-3 md:mb-5">Dapatkan <span
                class="text-red-500">Fitur</span>
            Menarik</h3>
        <p class="text-gray-500 mb-2 md:mb-8 text-center text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing
            elit.
            Eveniet,
            reprehenderit?</p>
        <div class="w-11/12 md:container mx-auto grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="col-span-2 flex justify-center items-center">
                <img src="https://masjidagungalazhar.com/assets/images/about-left-image.png" alt=""
                    class="md:w-8/12 md:block hidden">
            </div>
            <div class="col-span-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Service 1 -->
                <div
                    class="flex space-x-6 py-4 px-4 text-white bg-red-500 md:bg-blue-900 md:text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-01.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Media Silaturahmi</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
                <!-- Service 2 -->
                <div
                    class="flex space-x-6 py-4 px-4 text-white bg-red-500 md:bg-blue-900 md:text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-02.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Media Donasi</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
                <!-- Service 3 -->
                <div
                    class="flex space-x-6 py-4 px-4 text-white bg-red-500 md:bg-blue-900 md:text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-03.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Media Belajar</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
                <!-- Service 4 -->
                <div
                    class="flex space-x-6 py-4 px-4 text-white bg-red-500 md:bg-blue-900 md:text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-04.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Nofitikasi</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rekening -->
    <section id="rekening" class="py-20 md:py-32 bg-white">
        <h3 class="text-4xl md:text-5xl font-bold text-center mb-3 md:mb-5">Salurkan <span
                class="text-blue-900">Donasi</span>
            Anda</h3>
        <p class="text-gray-500 mb-5 text-center text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Eveniet,
            reprehenderit?</p>
        <div class="grid grid-cols-2 md:grid-cols-4 w-11/12 md:container mx-auto gap-6 mb-2">
            <!-- Rekening 1 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/bni_syariah.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Lorem, ipsum.</h4>
                        <p class="text-center">Lorem ipsum dolor sit.</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 2 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/mandiri_syariah.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>
            <!-- Rekening 3 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/btn_syariah.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>
            <!-- Rekening 4-->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/muamalat.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>

        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 w-11/12 md:container mx-auto gap-6 mb-4">
            <!-- Rekening 5 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/permata_syariah.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Lorem, ipsum.</h4>
                        <p class="text-center">Lorem ipsum dolor sit.</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 6 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/mandiri.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>
            <!-- Rekening 7 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/bri_syariah.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>
            <!-- Rekening 8 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://masjidagungalazhar.com/assets/images/bank_bsi.png" alt=""
                        class="w-full py-10 px-10">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>

        </div>
    </section>

    {{-- Layanan --}}
    <section id="layanan" class="w-11/12 md:container mx-auto py-20 md:py-32">
        <!-- Section 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 items-start text-sm mb-10">
            <div>
                <h3 class="text-5xl font-bold mb-5">Aula Buya Hamka</h3>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem deserunt at aliquam
                    harum? Eligendi eos sit hic nihil atque sed alias optio? Commodi veritatis consequatur, amet
                    praesentium fugiat asperiores quae.</p>
                <p class="mb-5 pb-5 border-b border-gray-900">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Beatae inventore, suscipit delectus, placeat earum rerum omnis dolores quasi fugit deserunt illo
                    ducimus? Asperiores, odio quia!</p>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="https://masjidagungalazhar.com/assets/images/blog-thumb-01.jpg"
                    class="rounded-3xl w-full md:w-2/3" alt="">
            </div>
        </div>

        <!-- Section 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 items-start text-sm mb-10">
            <div class="flex justify-center md:justify-start">
                <img src="https://masjidagungalazhar.com/assets/images/blog-thumb-02.jpg"
                    class="rounded-3xl w-full md:w-2/3" alt="">
            </div>
            <div>
                <h3 class="text-5xl font-bold mb-5">Amal Usaha</h3>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem deserunt at aliquam
                    harum? Eligendi eos sit hic nihil atque sed alias optio? Commodi veritatis consequatur, amet
                    praesentium fugiat asperiores quae.</p>
                <p class="mb-5 pb-5 border-b border-gray-900">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Beatae inventore, suscipit delectus, placeat earum rerum omnis dolores quasi fugit deserunt illo
                    ducimus? Asperiores, odio quia!</p>
            </div>
        </div>

        <!-- Section 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 items-start text-sm">
            <div>
                <h3 class="text-5xl font-bold mb-5">Konsultasi & Pengislaman</h3>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem deserunt at aliquam
                    harum? Eligendi eos sit hic nihil atque sed alias optio? Commodi veritatis consequatur, amet
                    praesentium fugiat asperiores quae.</p>
                <p class="mb-5 pb-5 border-b border-gray-900">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Beatae inventore, suscipit delectus, placeat earum rerum omnis dolores quasi fugit deserunt illo
                    ducimus? Asperiores, odio quia!</p>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="https://masjidagungalazhar.com/assets/images/blog-thumb-03.jpg"
                    class="rounded-3xl w-full md:w-2/3" alt="">
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="text-center text-xs mx-auto py-10 md:text-sm w-3/4">
        Masjid Agung Al Azhar | Epicentrum Dakwah dan Sosial &copy; 2024 Design by Staf ICT MAA
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
