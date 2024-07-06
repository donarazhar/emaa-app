<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Tailsimple</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <!-- Header -->
    <header class="bg-gray-900 sticky top-0">
        <nav class="w-11/12 md:container mx-auto py-4 flex justify-between items-center text-white">
            <a href="#" class="text-3xl font-bold">Tailsimple</a>
            <ul class="menu hidden md:flex md:bg-gray-900 md:relative md:top-0 md:w-auto">
                <li class="px-7 py-1 hover:text-gray-500"><a href="#services">Services</a></li>
                <li class="px-7 py-1 hover:text-gray-500"><a href="#portofolio">Portfolio</a></li>
                <li class="px-7 py-1 hover:text-gray-500"><a href="#about">About</a></li>
                <li class="px-7 py-1 hover:text-gray-500 md:hover:text-white">
                    <a href="#"
                        class="md:border-2 md:border-red-500 md:py-2 md:px-5 md:rounded-xl md:hover:bg-red-500 text-white">Getting
                        Started</a>
                </li>
            </ul>
            <button class="hamburger-menu text-2xl md:hidden">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark hidden"></i>
            </button>
        </nav>
    </header>

    <!-- Hero -->
    <section class="bg-gray-900">
        <div class="container mx-auto text-center text-white h-screen flex items-center">
            <div class="mx-auto w-3/4 md:w-2/4">
                <h3 class="text-5xl font-bold text-center mb-5">Bring Your Business To The Next Level</h3>
                <p class="text-gray-500 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam non
                    nihil ratione eveniet assumenda facilis.</p>
                <a href="#portofolio" class="bg-red-500 text-white py-2 px-5 rounded-xl hover:bg-red-800">See All
                    Portfolio</a>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="bg-gray-200 py-20">
        <div class="w-11/12 md:container mx-auto">
            <h3 class="text-5xl font-bold text-center mb-5">Our Services</h3>
            <p class="text-gray-500 text-center mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Temporibus, aperiam.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Service 1 -->
                <div class="flex space-x-5 py-8 px-8 bg-white rounded-xl items-start">
                    <img src="https://placehold.co/100" alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-5">Data Analytics</h4>
                        <p class="text-gray-500 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                            inventore odio illum corporis error esse.</p>
                        <a href="#" class="hover:text-gray-500">read more</a>
                    </div>
                </div>
                <!-- Service 2 -->
                <div class="flex space-x-5 py-8 px-8 bg-white rounded-xl items-start">
                    <img src="https://placehold.co/100" alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-5">Social Media Assistant</h4>
                        <p class="text-gray-500 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                            inventore odio illum corporis error esse.</p>
                        <a href="#" class="hover:text-gray-500">read more</a>
                    </div>
                </div>
                <!-- Service 3 -->
                <div class="flex space-x-5 py-8 px-8 bg-white rounded-xl items-start">
                    <img src="https://placehold.co/100" alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-5">Developer & Maintenance</h4>
                        <p class="text-gray-500 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                            inventore odio illum corporis error esse.</p>
                        <a href="#" class="hover:text-gray-500">read more</a>
                    </div>
                </div>
                <!-- Service 4 -->
                <div class="flex space-x-5 py-8 px-8 bg-white rounded-xl items-start">
                    <img src="https://placehold.co/100" alt="">
                    <div>
                        <h4 class="text-2xl font-bold mb-5">24/7 Protection</h4>
                        <p class="text-gray-500 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                            inventore odio illum corporis error esse.</p>
                        <a href="#" class="hover:text-gray-500">read more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio -->
    <section id="portofolio" class="py-20 bg-white">
        <h3 class="text-5xl font-bold text-center mb-5">Portfolio</h3>
        <p class="text-gray-500 mb-5 text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet,
            reprehenderit?</p>
        <div class="grid grid-cols-2 md:grid-cols-4 w-11/12 md:container mx-auto gap-6">
            <!-- Portfolio 1 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 1</h4>
                    </div>
                </a>
            </div>
            <!-- Portfolio 2 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 2</h4>
                    </div>
                </a>
            </div>
            <!-- Portfolio 3 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 3</h4>
                    </div>
                </a>
            </div>
            <!-- Portfolio 4 -->
            <div class="shadow-xl">
                <a href="#">
                    <img src="https://placehold.co/600x400" alt="" class="w-full">
                    <div class="py-3 px-5">
                        <h4 class="text-center font-bold">Website 4</h4>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="w-11/12 md:container mx-auto py-20">
        <div class="flex space-x-10 items-start">
            <img src="https://placehold.co/300" class="w-24 md:w-1/3" alt="">
            <div>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, nobis.</p>
                <h3 class="text-5xl font-bold mb-5">About Tailsimple</h3>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem deserunt at aliquam
                    harum?
                    Eligendi eos sit hic nihil atque sed alias optio? Commodi veritatis consequatur, amet praesentium
                    fugiat asperiores quae.</p>
                <p class="mb-5 pb-5 border-b border-gray-900">Lorem ipsum dolor sit, amet consectetur adipisicing
                    elit. Beatae inventore, suscipit delectus, placeat earum rerum omnis dolores quasi fugit deserunt
                    illo ducimus? Asperiores, odio quia!</p>
                <ul class="md:flex md:space-x-5">
                    <li><a href="#"><i class="fa-brands fa-tiktok"></i> Tiktok </a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i> Instagram </a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i> Twitter </a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i> Youtube </a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 text-center font-bold">
        &copy; 2024 Tailsimple
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
