<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Profile - Masjid Agung Al Azhar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        .shadow-top {
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-white p-4 flex justify-between items-center">
        <a href="/blog" class="text-gray-600 text-md md:text-xl">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-lg md:text-xl font-bold text-black text-center flex-grow">Profile</h1>
        <div class="w-6"></div> <!-- Placeholder to balance the back button -->
    </header>

    <!-- Hero Section -->
    <section class="relative">
        <div class="w-full h-40 md:h-60">
            <img src="https://c.inilah.com/2023/04/0415_104054_0e22_inilah.com_-1024x683.jpg" alt="Masjid Banner"
                class="w-full h-full object-cover">
        </div>
    </section>

    <!-- Profile Links -->
    <section class="p-4">
        @foreach ($profile as $item)
            <a href="{{ route('profile.show', ['id' => $item->id]) }}" class="block">
                <div class="bg-white rounded-xl shadow-md mb-4 p-4 flex items-center">
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}"
                        class="w-16 md:w-20 h-16 md:h-16 rounded-md mr-4">
                    <p class="text-md md:text-xl font-semibold">{{ $item->judul }}</p>
                    <i class="fa-solid fa-chevron-right ml-auto text-gray-400"></i>
                </div>
            </a>
        @endforeach
    </section>

    <!-- Bottom Nav -->
    <footer class="fixed bottom-0 left-0 w-full bg-white shadow-md shadow-top">
        <div class="flex justify-around p-2">
            <a href="/blog" class="text-center">
                <i class="fa-solid fa-house text-lg md:text-xl  hover:text-blue-900"></i>
                <p class="text-xs md:text-sm  hover:text-blue-900">Beranda</p>
            </a>
            <a href="#" class="text-center">
                <i class="fa-solid fa-newspaper text-lg md:text-xl  hover:text-blue-900"></i>
                <p class="text-xs md:text-sm  hover:text-blue-900">Artikel</p>
            </a>
            <a href="#" class="text-center">
                <i class="fa-solid fa-circle-dollar-to-slot text-lg md:text-xl  hover:text-blue-900"></i>
                <p class="text-xs md:text-sm  hover:text-blue-900">Donasi</p>
            </a>
            <a href="#" class="text-center">
                <i class="fa-solid fa-gear text-lg md:text-xl  hover:text-blue-900"></i>
                <p class="text-xs md:text-sm  hover:text-blue-900">Akun</p>
            </a>
        </div>
    </footer>

</body>

</html>
