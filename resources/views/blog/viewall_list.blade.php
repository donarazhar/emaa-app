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

<div class="mt-6 mb-10">
    {{ $articles->links() }}
</div>
