<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>{{ $artikel->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        .hidden {
            display: none;
        }

        .shadow-top {
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        #content {
            max-height: none;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-white text-white p-4">
        <div class="flex justify-between items-center">
            <img src="{{ asset('img/logo.png') }}" alt="Masjid Logo" class="h-8 md:h-12">
            <div class="text-center">
                <h1 class="text-lg md:text-xl font-bold text-black">Masjid Agung Al Azhar</h1>
                <p class="text-xs md:text-sm text-black">Masjid for Educational and Cultural Movement</p>
            </div>
            <button class="text-black text-xl md:text-2xl">
                <i class="fa-solid fa-bell"></i>
            </button>
        </div>
    </header>

    <!-- Back Section -->
    <section class="bg-gray-100 ml-2 p-2">
        <a href="{{ route('blog') }}" class="text-gray-600 text-md">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="ml-2">back</i>
        </a>
    </section>

    <!-- Hero Section -->
    <section id="main" class="relative">
        <div class="w-full h-64 md:h-96">
            <img src="{{ $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : 'https://placehold.co/600x400' }}"
                alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
        </div>
    </section>

    <!-- Article Content -->
    <section id="content" class="p-4 mt-4 pb-20 overflow-auto">
        <div class="max-w-6xl mx-auto bg-white p-4 md:p-8 shadow-md">
            <h1 class="text-xl md:text-2xl font-bold mb-2 md:mb-4">{{ $artikel->judul }}</h1>
            <p class="text-sm md:text-base text-gray-600 mb-2 md:mb-4">
                {{ \Carbon\Carbon::parse($artikel->tanggal_jam)->format('d F Y H:i') }}</p>
            <div class="text-sm md:text-base text-gray-700">
                {!! $artikel->isi !!}
            </div>
        </div>
    </section>

    <!-- Bottom Nav -->
    <footer class="fixed bottom-0 left-0 w-full bg-white shadow-md shadow-top">
        <div class="flex justify-around p-2">
            <a href="/blog" class="text-center text-xs md:text-sm">
                <i class="fa-solid fa-house text-lg md:text-xl"></i>
                <p>Beranda</p>
            </a>
            <a href="#" class="text-center text-xs md:text-sm">
                <i class="fa-solid fa-newspaper text-lg md:text-xl"></i>
                <p>Artikel</p>
            </a>
            <a href="#" class="text-center text-xs md:text-sm">
                <i class="fa-solid fa-circle-dollar-to-slot text-lg md:text-xl"></i>
                <p>Donasi</p>
            </a>
            <a href="#" class="text-center text-xs md:text-sm">
                <i class="fa-solid fa-gear text-lg md:text-xl"></i>
                <p>Akun</p>
            </a>
        </div>
    </footer>

</body>

</html>
