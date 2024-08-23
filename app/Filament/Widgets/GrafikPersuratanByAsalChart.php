<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SuratTransaksi;

class GrafikPersuratanByAsalChart extends ChartWidget
{
    protected static ?string $heading = 'Surat Per Asal Surat';
    protected int | string | array $columnSpan = 3;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 3;

    public function getDescription(): ?string
    {
        return 'Distribusi sesuai asal surat.';
    }


    protected function getData(): array
    {
        // Menghitung jumlah surat per asal surat
        $perasalsurat = SuratTransaksi::selectRaw('asal_surat_id, COUNT(*) as jumlah')
            ->groupBy('asal_surat_id')
            ->with('asal')
            ->get();

        // Membuat label asal surat berdasarkan nama asal surat
        $labels = $perasalsurat->pluck('asal.nama_asal_surat')->toArray();
        $data = $perasalsurat->pluck('jumlah')->toArray();

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
