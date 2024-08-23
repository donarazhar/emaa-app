<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SuratTransaksi;

class GrafikPersuratanByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Surat Per Kategori';
    protected int | string | array $columnSpan = 3;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 3;

    public function getDescription(): ?string
    {
        return 'Distribusi sesuai kategori.';
    }


    protected function getData(): array
    {
        // Menghitung jumlah surat per kategori
        $perkategori = SuratTransaksi::selectRaw('kategori_surat_id, COUNT(*) as jumlah')
            ->groupBy('kategori_surat_id')
            ->with('kategori')
            ->get();

        // Membuat label kategori berdasarkan nama kategori
        $labels = $perkategori->pluck('kategori.nama_kategori')->toArray();
        $data = $perkategori->pluck('jumlah')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Surat',
                    'data' => $data,
                    'backgroundColor' => ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#ff9f40'],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
