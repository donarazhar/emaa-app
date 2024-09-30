<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>View All Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-white text-black p-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('blog') }}" class="text-black">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
    </header>


    <!-- Search Section -->
    <section class="p-4">
        <input type="text" name="search" id="search-input" placeholder="Search"
            value="{{ request()->input('search') }}" class="w-full p-2 rounded-md border border-gray-300">
    </section>

    <!-- Articles List -->
    <section class="p-4" id="articles-list">
        @foreach ($articles as $item)
            <a href="{{ route('article.show', ['id' => $item->id]) }}" class="block">
                <div class="bg-white rounded-lg shadow-md mb-4 p-4 flex items-center">
                    <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : 'https://placehold.co/600x400' }}"
                        alt="{{ $item->judul }}" class="w-16 h-16 rounded-md mr-4">
                    <div>
                        <p class="text-md font-semibold">{{ $item->judul }}</p>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal_jam)->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </a>
        @endforeach

        <!-- Pagination Links -->
        <div class="mt-6 mb-10">
            {{ $articles->links() }}
        </div>
    </section>

    <!-- JavaScript untuk pencarian instan -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('input', function() {
                const searchQuery = searchInput.value;

                // Menggunakan Fetch API untuk mengirimkan permintaan pencarian
                fetch(
                        `{{ route('article.viewAll', ['categoryId' => $kategori->id]) }}?search=${searchQuery}`
                    )
                    .then(response => response.text())
                    .then(data => {
                        // Mengganti konten artikel dengan hasil pencarian
                        document.getElementById('articles-list').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>

</body>

</html>
