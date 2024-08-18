<x-filament-widgets::widget>
    <x-filament::section>
        <!-- Header Section -->
        <div class="mb-4">
            <h2 class="text-md font-bold text-gray-800">Laporan Kerja</h2>
            <p class="text-gray-300 text-sm">{{ $this->getDescription() }}</p>
        </div>

        <!-- Slider Section -->
        <div x-data="{ currentIndex: 0, totalItems: {{ count($beritaSlider) }}, visibleItems: {{ $initialVisible }} }" class="relative overflow-hidden">
            <div x-ref="sliderContainer" class="flex transition-transform space-x-4 snap-x snap-mandatory scroll-smooth"
                :style="`transform: translateX(-${currentIndex * (100 / visibleItems)}%); width: ${totalItems * 100 / visibleItems}%`;">
                @foreach ($beritaSlider as $index => $berita)
                    <div
                        class="flex-none w-full md:w-1/{{ $initialVisible }} lg:w-1/{{ $initialVisible }} snap-start relative transition-transform transform hover:scale-105 hover:z-10 px-1">
                        <x-filament::card class="overflow-hidden">
                            <div class="relative aspect-video mb-2">
                                @if (!empty($berita->foto_laporkerja) && is_array($berita->foto_laporkerja))
                                    <img src="{{ asset('storage/' . $berita->foto_laporkerja[0]) }}"
                                        alt="{{ $berita->judul }} {{ $berita->user->name }}"
                                        class="w-full h-full object-cover rounded-t-xl">
                                @else
                                    <div
                                        class="w-full h-full bg-gray-300 rounded-t-xl flex items-center justify-center">
                                        <span class="text-gray-600 text-sm">No Image Available</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gray-300 bg-opacity-50 rounded-t-xl opacity-0 transition-opacity duration-300 hover:opacity-100 flex items-end p-4">
                                    <div class="text-gray-600">
                                        <p class="mt-1 text-xs">{{ Str::limit($berita->isi, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1 text-left">
                                {{ $berita->judul }}
                            </div>
                            <div class="text-xs text-gray-500 text-left">
                                oleh : {{ $berita->user->name }}
                            </div>
                            <div class="text-xs text-gray-500 text-left">
                                {{ \Carbon\Carbon::parse($berita->tgl)->locale('id')->translatedFormat('d/M/Y') }}
                            </div>
                        </x-filament::card>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <button
                @click="if(currentIndex > 0) currentIndex--; $refs.sliderContainer.scrollTo({left: $refs.sliderContainer.offsetWidth * currentIndex / visibleItems, behavior: 'smooth'})"
                style="position: absolute; top: 50%; left: 5px; transform: translateY(-50%); background: gray; color: white; padding: 5px; font-size: 5px; z-index: 1000; border-radius: 50%;">
                <x-heroicon-m-chevron-double-left class="w-6 h-6 text-black" />
            </button>

            <button
                @click="if(currentIndex < totalItems - visibleItems) currentIndex++; $refs.sliderContainer.scrollTo({left: $refs.sliderContainer.offsetWidth * currentIndex / visibleItems, behavior: 'smooth'})"
                style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); background: gray; color: white; padding: 5px; font-size: 5px; z-index: 1000; border-radius: 50%;">
                <x-heroicon-m-chevron-double-right class="w-6 h-6 text-white" />
            </button>




        </div>

        <!-- Button Section -->
        <div class="text-center mt-4">
            <x-filament::button>
                <a href="{{ route('filament.admin.resources.lapor-kerjas.index') }}" class="text-white">
                    Lihat semua data
                </a>
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
