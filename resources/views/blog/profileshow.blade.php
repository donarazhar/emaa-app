<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png') }}">
    <title>{{ $profile->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        /* CSS tambahan untuk elemen HTML */
        ol,
        ul,
        li {
            margin-left: 1.5em;
            padding-left: 1em;
            list-style-position: inside;
        }

        blockquote {
            border-left: 4px solid #ddd;
            padding-left: 1em;
            margin: 1em 0;
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Back Button -->
    <section class="relative bg-blue-900">
        <a href="{{ route('profile') }}"
            class="absolute top-4 left-4 bg-white text-blue-900 text-md p-3 rounded-full shadow hover:bg-opacity-100 transition">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <!-- Hero Image -->
        <div class="w-full h-48 md:h-64 bg-cover bg-center"
            style="background-image: url('{{ asset('storage/' . $profile->thumbnail) }}');">
        </div>
    </section>

    <!-- Content Section -->
    <section class="p-4">
        <h2 class="text-xl md:text-2xl font-bold mb-2">{{ $profile->judul }}</h2>
        <div class="border-t-2 border-blue-500 w-24 mb-4"></div>
        <div class="text-md md:text-lg text-gray-700">
            {!! $profile->isi !!}
        </div>
    </section>
</body>

</html>
