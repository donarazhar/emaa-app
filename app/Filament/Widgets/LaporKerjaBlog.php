<?php

namespace App\Filament\Widgets;

use App\Models\LaporKerja;
use Filament\Widgets\Widget;

class LaporKerjaBlog extends Widget
{
    protected static ?string $heading = 'Blog Lapor Kerja';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = null;
    protected static string $view = 'filament.widgets.lapor-kerja-blog';

    public function getDescription(): ?string
    {
        return 'Menampilkan laporan pekerjaan harian marbot.';
    }

    protected function getViewData(): array
    {
        $beritaSlider = LaporKerja::with('user')
            ->orderBy('tgl', 'desc')
            ->take(20) // Ambil total 14 berita untuk ditampilkan
            ->get();

        return [
            'beritaSlider' => $beritaSlider,
            'initialVisible' => 4, // Jumlah berita yang akan tampil diawal
        ];
    }
}
