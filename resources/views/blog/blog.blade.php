<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Informasi MAA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .hidden {
            display: none;
        }

        footer .flex {
            flex-wrap: wrap;
            /* Membuat item flex bisa membungkus ke baris berikutnya */
        }

        footer .text-center {
            flex: 1 1 25%;
            /* Setiap item memiliki lebar minimum 25% dari kontainer */
            max-width: 25%;
        }

        @media (max-width: 768px) {
            footer .fa-solid {
                font-size: 1.25rem;
                /* Ukuran font ikon lebih kecil untuk mobile */
            }

            footer .text-xs {
                font-size: 0.75rem;
                /* Ukuran teks lebih kecil untuk mobile */
            }
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-white text-white p-3 md:p-4">
        <div class="flex justify-between items-center">
            <a href="/" class="text-3xl font-bold">
                <img src="{{ asset('img/logomaa.png') }}" alt="Logo MAA" class="h-8 md:h-12">
            </a>
            <div class="text-center">
                <h1 class="text-lg md:text-xl font-bold text-black">Masjid Agung Al Azhar</h1>
                <p class="text-xs md:text-sm text-black">Masjid for Educational and Cultural Movement</p>
            </div>
            <button class="text-black text-xl md:text-2xl">
                <i class="fa-solid fa-bell"></i>
            </button>
        </div>
    </header>

    <!-- Hero -->
    <section id="main" class="relative bg-blue-900">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @forelse ($banner as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->nama }}"
                            class="w-full h-auto object-cover">
                    </div>
                @empty
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/file-user/no-image-banner.jpg') }}" alt="No Image Available"
                            class="w-full h-auto object-cover">
                    </div>
                @endforelse
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Nav Icon -->
    <section id="navigation" class="grid grid-cols-3 gap-2 md:gap-4 py-2 md:py-4 px-2 md:px-4">
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 text-center flex flex-col items-center">
            <a href="{{ route('profile') }}">
                <img src="img/profile.png" class="w-10 md:w-16 mb-1 md:mb-2" alt="">
                <p class="text-xs md:text-sm font-bold">Profile</p>
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 text-center flex flex-col items-center">
            <a href="{{ route('giatMasjid') }}">
                <img src="img/calender.png" class="w-10 md:w-16 mb-1 md:mb-2" alt="">
                <p class="text-xs md:text-sm font-bold">Giat Masjid</p>
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 text-center flex flex-col items-center">
            <img src="img/tv.png" class="w-10 md:w-16 mb-1 md:mb-2" alt="">
            <p class="text-xs md:text-sm font-bold">MAA TV</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 text-center flex flex-col items-center">
            <img src="img/buletin.png" class="w-10 md:w-16 mb-1 md:mb-2" alt="">
            <p class="text-xs md:text-sm font-bold">Buletin</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 text-center flex flex-col items-center">
            <img src="img/konsultasi.png" class="w-10 md:w-16 mb-1 md:mb-2" alt="">
            <p class="text-xs md:text-sm font-bold">Konsultasi</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-2 md:p-4 text-center flex flex-col items-center">
            <img src="img/saran.png" class="w-10 md:w-16 mb-1 md:mb-2" alt="">
            <p class="text-xs md:text-sm font-bold">Saran</p>
        </div>
    </section>

    <!-- Tabs News -->
    <section id="tabs" class="my-2 md:my-4 px-2 md:px-4">
        <div class="flex justify-start overflow-x-auto bg-gray-200 p-1 md:p-2 rounded-md space-x-2 md:space-x-4">
            @foreach ($tabs as $tab)
                <button id="tab-{{ Str::slug($tab->nama) }}"
                    class="px-2 md:px-4 py-1 md:py-2 rounded-md text-sm md:text-base whitespace-nowrap {{ $loop->first ? 'bg-blue-900 text-white' : 'text-gray-600' }}"
                    onclick="openTab('content-{{ Str::slug($tab->nama) }}', this)">
                    {{ $tab->nama }}
                </button>
            @endforeach
        </div>
    </section>

    <!-- Content Section -->
    @foreach ($tabs as $tab)
        <section id="content-{{ Str::slug($tab->nama) }}" class="p-2 md:p-4 {{ !$loop->first ? 'hidden' : '' }}">
            @foreach ($artikel[$tab->id] as $item)
                <a href="{{ route('article.show', ['id' => $item->id]) }}" class="block">
                    <div class="bg-white p-2 md:p-4 rounded-md shadow-md mb-2 md:mb-4">
                        <div class="flex items-center">
                            <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://placehold.co/200' }}"
                                alt="{{ $item->judul }}" class="w-16 h-16 md:w-20 md:h-20 object-cover mr-2 md:mr-4">
                            <div>
                                <p class="text-sm md:text-base font-semibold">{{ $item->judul }}</p>
                                <p class="text-xs md:text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal_jam)->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

            @if (empty($artikel[$tab->id]) || $artikel[$tab->id]->isEmpty())
                <p class="text-center text-gray-500 text-sm md:text-base">No articles available in this category.</p>
            @endif

            <div class="text-center mt-2 md:mt-4">
                <a href="{{ route('article.viewAll', ['categoryId' => $tab->id]) }}"
                    class="bg-blue-900 text-white px-3 md:px-4 py-1 md:py-2 text-sm md:text-base rounded-md">
                    View All
                </a>
            </div>
        </section>
    @endforeach

    <!-- Donasi -->
    <section id="services" class="py-10 md:py-20 bg-white mb-8 md:mb-8">
        <h3 class="text-3xl md:text-5xl font-bold text-center mb-3 md:mb-5">Program</h3>
        <p class="text-gray-500 mb-3 md:mb-5 text-center text-sm md:text-base px-4">Beberapa program yang sedang kami
            laksanakan, dan mengajak jamaah sekalian untuk dapat berpartisipasi</p>
        <div class="grid grid-cols-2 md:grid-cols-4 w-11/12 md:container mx-auto gap-3 md:gap-6">
            @foreach ($donasi as $item)
                <div class="shadow-xl">
                    <a href="{{ $item->link }}">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://placehold.co/600x400' }}"
                            alt="{{ $item->nama }}" class="w-[200px] h-[100px] object-cover">
                        <div class="py-2 md:py-3 px-3 md:px-5">
                            <h4 class="text-center font-bold text-sm md:text-base">{{ $item->nama }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Bottom Nav -->
    <footer class="fixed bottom-0 left-0 w-full bg-white shadow-md shadow-top">
        <div class="flex justify-around p-2">
            <a href="/blog" class="text-center flex-1">
                <i class="fa-solid fa-house text-lg md:text-xl hover:text-blue-900"></i>
                <p class="text-xs md:text-sm hover:text-blue-900">Beranda</p>
            </a>
            <a href="#" class="text-center flex-1">
                <i class="fa-solid fa-newspaper text-lg md:text-xl hover:text-blue-900"></i>
                <p class="text-xs md:text-sm hover:text-blue-900">Artikel</p>
            </a>
            <a href="#" class="text-center flex-1">
                <i class="fa-solid fa-circle-dollar-to-slot text-lg md:text-xl hover:text-blue-900"></i>
                <p class="text-xs md:text-sm hover:text-blue-900">Donasi</p>
            </a>
            <a href="#" class="text-center flex-1">
                <i class="fa-solid fa-gear text-lg md:text-xl hover:text-blue-900"></i>
                <p class="text-xs md:text-sm hover:text-blue-900">Akun</p>
            </a>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                },
            });
        });
    </script>

    <script>
        function openTab(tabId, button) {
            // Hapus kelas aktif dari semua tombol tab
            var tabs = document.querySelectorAll('[id^="tab-"]');
            tabs.forEach(function(tab) {
                tab.classList.remove('bg-blue-900', 'text-white');
                tab.classList.add('text-gray-600');
            });

            // Menambahkan kelas aktif ke tombol yang diklik
            button.classList.remove('text-gray-600');
            button.classList.add('bg-blue-900', 'text-white');

            // Sembunyikan semua konten tab
            var contents = document.querySelectorAll('[id^="content-"]');
            contents.forEach(function(content) {
                content.classList.add('hidden');
            });

            // Tampilkan konten tab yang dipilih
            document.getElementById(tabId).classList.remove('hidden');
        }
    </script>

</body>

</html>
