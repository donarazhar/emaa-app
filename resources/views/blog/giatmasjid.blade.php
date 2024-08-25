<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Giat Masjid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        .active-tab {
            background-color: #1E3A8A;
            /* bg-blue-900 */
            color: white;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="bg-white text-black p-4 flex items-center">
        <a href="{{ route('blog') }}" class="text-md font-bold mr-4">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-md font-bold">Giat Masjid</h1>
    </header>

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
        <section id="content-{{ Str::slug($tab->nama) }}" class="p-4 {{ !$loop->first ? 'hidden' : '' }}">
            @foreach ($tab->giatMasjids as $item)
                <a href="{{ route('giatMasjid.show', ['id' => $item->id]) }}" class="block">
                    <div class="bg-white rounded-lg shadow-md mb-4 p-4 flex items-center">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://placehold.co/600x400' }}"
                            alt="{{ $item->judul }}" class="w-16 h-16 rounded-md mr-4">
                        <div>
                            <p class="text-md font-semibold">{{ $item->judul }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->tanggal_jam)->format('d F Y H:i') }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-right ml-auto text-gray-400"></i>
                    </div>
                </a>
            @endforeach
        </section>
    @endforeach

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
