<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>Semua Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-blue-900 text-white p-4">
        <div class="flex justify-between items-center">
            <a href="/blog" class="text-white">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-lg md:text-xl font-bold text-white">Semua Artikel</h1>
            <div class="w-8"></div> <!-- Placeholder for alignment -->
        </div>
    </header>

    <!-- Search Section -->
    <section class="p-4">
        <input type="text" id="searchInput" placeholder="Search" value="{{ $search }}"
            class="w-full p-2 rounded-md border border-gray-300">
    </section>

    <!-- Articles List -->
    <section class="p-4">
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

        <!-- Pagination -->
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </section>

    <!-- JavaScript for Live Search -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            window.location.href = '{{ route('allArticles') }}?search=' + this.value;
        });
    </script>

</body>

</html>
