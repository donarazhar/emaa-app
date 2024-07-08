<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Masjid Agung Al Azhar with Tailwindcss</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    <!-- Header Navbar -->
    <header class="bg-blue-900 sticky top-0 z-50">
        <nav class="w-11/12 md:container mx-auto py-4 flex justify-between items-center text-white">
            <a href="#" class="text-3xl font-bold">
                <img class="h-10 w-10" src="{{ asset('img/logomaa.png') }}" alt="">
            </a>
            <ul class="hidden md:flex space-x-4">
                <li><a href="/" class="px-4 py-2 hover:text-white hover:bg-red-500 rounded-lg">Beranda</a></li>
                <li><a href="#fitur" class="px-4 py-2 hover:text-white hover:bg-red-500 rounded-lg">Fitur</a></li>
                <li><a href="#rekening" class="px-4 py-2 hover:text-white hover:bg-red-500 rounded-lg">Rekening</a></li>
                <li><a href="#layanan" class="px-4 py-2 hover:text-white hover:bg-red-500 rounded-lg">Layanan</a></li>
                <li><a href="#download" class="px-4 py-2 hover:text-white hover:bg-red-500 rounded-lg">Download</a></li>
                <li><a href="#about" class="px-4 py-2 hover:text-white hover:bg-red-500 rounded-lg">Donasi Online</a>
                </li>
                <li><a href="#" class="px-6 py-2 border-2 bg-red-500 rounded-xl hover:bg-blue-900">Info MAA</a>
                </li>
            </ul>
            <button class="md:hidden text-2xl">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark hidden"></i>
            </button>
        </nav>
    </header>

    <!-- Hero -->
    <section id="hero" class="bg-blue-900">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative overflow-hidden">
                    <img src="https://c.inilah.com/2023/04/0415_104054_0e22_inilah.com_-1024x683.jpg" alt=""
                        class="absolute inset-0 h-full w-full object-cover opacity-10">
                    <div
                        class="container mx-auto text-center text-white h-screen grid grid-cols-1 md:grid-cols-2 items-center relative z-10">
                        <div class="mx-auto w-3/4">
                            <p class="text-sm font-italic mb-5">Assalamualaikum Warrahmatullahi Wabarakatuh.</p>
                            <h3 class="text-5xl font-bold mb-5"><span class="text-red-500">Masjid for</span> Educational
                                and Cultural <span class="text-red-500">Movement</span></h3>
                            <p class="mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam non
                                nihil ratione eveniet assumenda facilis.</p>
                            <a href="#portofolio"
                                class="bg-red-500 text-white py-2 px-8 rounded-xl hover:bg-blue-900 hover:border-2">Selengkapnya...</a>
                        </div>
                        <div class="mx-auto hidden md:block">
                            <img src="{{ asset('hero/maa.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide relative overflow-hidden">
                    <img src="https://c.inilah.com/2023/04/0415_104054_0e22_inilah.com_-1024x683.jpg" alt=""
                        class="absolute inset-0 h-full w-full object-cover opacity-10">
                    <div
                        class="container mx-auto text-center text-white h-screen grid grid-cols-1 md:grid-cols-2 items-center relative z-10">
                        <div class="mx-auto w-3/4">
                            <p class="text-sm font-italic mb-5">Assalamualaikum Warrahmatullahi Wabarakatuh.</p>
                            <h3 class="text-5xl font-bold mb-5"><span class="text-red-500">Satu Aplikasi</span> untuk
                                GEMILANG <span class="text-red-500">Masjidku</span></h3>
                            <p class="mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam non
                                nihil ratione eveniet assumenda facilis.</p>
                            <a href="#portofolio"
                                class="bg-red-500 text-white py-2 px-8 rounded-xl hover:bg-blue-900 hover:border-2">Selengkapnya...</a>
                        </div>
                        <div class="mx-auto hidden md:block">
                            <img src="{{ asset('hero/maa.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- Add more slides as needed -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Fitur -->
    <section id="fitur" class="bg-white py-20 px-4 md:py-32 md:px-4">
        <h3 class="text-4xl md:text-5xl font-bold text-center mb-5">Dapatkan <span class="text-red-500">Fitur</span>
            Menarik</h3>
        <p class="text-gray-500 mb-8 text-center text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Eveniet, reprehenderit?</p>
        <div class="w-11/12 md:container mx-auto grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="col-span-2 flex justify-center items-center">
                <img src="https://masjidagungalazhar.com/assets/images/about-left-image.png" alt=""
                    class="md:w-8/12 hidden md:block">
            </div>
            <div class="col-span-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Service 1 -->
                <div class="flex space-x-6 py-4 px-4 bg-blue-900 text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-01.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Media Silaturahmi</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
                <!-- Service 2 -->
                <div class="flex space-x-6 py-4 px-4 bg-blue-900 text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-02.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Media Donasi</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
                <!-- Service 3 -->
                <div class="flex space-x-6 py-4 px-4 bg-blue-900 text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-03.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Media Belajar</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
                <!-- Service 4 -->
                <div class="flex space-x-6 py-4 px-4 bg-blue-900 text-white rounded-xl items-start">
                    <img class="h-16 w-16 mt-4" src="https://masjidagungalazhar.com/assets/images/service-icon-04.png"
                        alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-2">Notifikasi</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia inventore odio illum
                            corporis error esse.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rekening -->
    <section id="rekening" class="py-20 px-4 md:py-32 md:px-4 bg-white">
        <h3 class="text-4xl md:text-5xl font-bold text-center mb-5">Salurkan <span class="text-blue-900">Donasi</span>
            Anda</h3>
        <p class="text-gray-500 mb-5 text-center text-sm">Donasi operasional Masjid Agung Al Azhar dapat jamaah
            salurkan melalui rekening dibawah ini:</p>
        <!-- Container untuk semua kartu -->
        <div class="grid grid-cols-2 md:grid-cols-4 w-11/12 md:container mx-auto gap-4 mb-4">
            <!-- Rekening 1 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/bni_syariah.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">BNI Syariah</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 2 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/mandiri_syariah.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">Mandiri Syariah</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 3 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/btn_syariah.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">BTN Syariah</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 4 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/muamalat.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">Muamalat</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 5 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/permata_syariah.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">Permata Syariah</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 6 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/mandiri.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">Mandiri</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 7 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/bri_syariah.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">BRI Syariah</p>
                    </div>
                </a>
            </div>
            <!-- Rekening 8 -->
            <div class="shadow-xl rounded-xl flex justify-center items-center relative group h-48">
                <a href="#" class="flex flex-col justify-center items-center">
                    <img src="https://masjidagungalazhar.com/assets/images/bank_bsi.png" alt=""
                        class="w-1/2 mx-auto py-6 px-6">
                    <div
                        class="absolute inset-0 bg-red-600 bg-opacity-90 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <p class="text-white text-lg font-bold">BSI</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section id="layanan" class="py-20 px-4 md:py-32 md:px-4 bg-white">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Kolom 1/3 -->
                <div class="col-span-1 md:col-span-2 relative">
                    <h3 class="text-4xl md:text-5xl font-bold text-left mb-5 leading-tight">
                        Layanan <span class="text-blue-900">Terbaik Yang</span><br class="hidden md:block"> Selalu
                        Kami <span class="text-red-500">Berikan</span>
                    </h3>
                    <img class="shadow-2xl rounded-3xl mt-6"
                        src="https://masjidagungalazhar.com/assets/images/big-blog-thumb.jpg" alt="">
                    <!-- Card melayang -->
                    <div class="absolute bottom-4 left-4 right-4 bg-white bg-opacity-90 p-6 rounded-xl shadow-xl">
                        <h4 class="text-xl font-bold text-gray-800">Kantor Kami</h4>
                        <p class="text-gray-700 mb-5">Jl. Sisingamangaraja, Kebayoran Baru, Jakarta Selatan, 12110,
                            Telp (021) 727-83683</p>
                        <a class="bg-blue-500 text-white px-6 py-2 rounded-xl hover:bg-blue-600 transition duration-300"
                            href="">Cari di Google Maps</a>
                    </div>
                </div>

                <!-- Kolom 2/3 -->
                <div class="col-span-1 md:col-span-2 bg-white p-6 rounded-3xl shadow-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Subkolom content 1 -->
                        <div class="flex flex-col justify-center items-start text-left">
                            <h2 class="text-3xl font-bold text-gray-600 mb-4">Aula Buya Hamka</h2>
                            <p class="text-lg text-gray-600">Aula serba guna yang dapat digunakan untuk acara yang
                                direncanakan...</p>
                        </div>
                        <div class="flex justify-center items-center">
                            <img src="https://masjidagungalazhar.com/assets/images/blog-thumb-01.jpg"
                                alt="Aula Buya Hamka" class="w-3/4 h-auto shadow-2xl rounded-3xl">
                        </div>

                        <!-- Subkolom content 2 -->
                        <div class="flex flex-col justify-center items-start text-left">
                            <h2 class="text-3xl font-bold text-gray-600 mb-4">Amal Usaha</h2>
                            <p class="text-lg text-gray-600">Toko online Masjid Agung Al Azhar di Shopee dan
                                Tokopedia...</p>
                        </div>
                        <div class="flex justify-center items-center">
                            <img src="https://masjidagungalazhar.com/assets/images/blog-thumb-02.jpg" alt="Amal Usaha"
                                class="w-3/4 h-auto shadow-2xl rounded-3xl">
                        </div>

                        <!-- Subkolom content 3 -->
                        <div class="flex flex-col justify-center items-start text-left">
                            <h2 class="text-3xl font-bold text-gray-600 mb-4">Konsultasi & Pengislaman</h2>
                            <p class="text-lg text-gray-600">Konsultasikan masalah anda ke Masjid Agung Al Azhar...</p>
                        </div>
                        <div class="flex justify-center items-center">
                            <img src="https://masjidagungalazhar.com/assets/images/blog-thumb-03.jpg"
                                alt="Konsultasi & Pengislaman" class="w-3/4 h-auto shadow-2xl rounded-3xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download -->
    <section id="download" class="bg-blue-900 relative overflow-hidden h-screen flex items-center">
        <img src="https://c.inilah.com/2023/04/0415_104054_0e22_inilah.com_-1024x683.jpg" alt=""
            class="absolute inset-0 h-full w-full object-cover opacity-10">
        <div
            class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center relative z-10 text-left text-white px-4 md:px-8">
            <div class="w-full flex flex-col justify-center items-start h-full">
                <h3 class="text-4xl md:text-5xl font-bold mb-5">Unduh Dan Hadirkan Masjid Agung Al Azhar Di Genggaman
                    Anda.</h3>
                <img src="https://masjidagungalazhar.com/assets/images/gplay.png" alt=""
                    class="h-full md:h-auto object-contain">
            </div>
            <div class="w-full flex justify-center items-center h-full">
                <img src="https://masjidagungalazhar.com/assets/images/ilustrasi.png" alt=""
                    class="w-3/4 md:w-full mx-auto h-auto">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-xs mx-auto py-10 md:text-sm w-3/4">
        Masjid Agung Al Azhar | Epicentrum Dakwah dan Sosial &copy; 2024 Design by Staf ICT MAA
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

        });
    </script>

</body>

</html>
