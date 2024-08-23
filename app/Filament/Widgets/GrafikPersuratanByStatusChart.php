<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SuratTransaksi;

class GrafikPersuratanByStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Surat Per Status';
    protected int | string | array $columnSpan = 3;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 3;

    public function getDescription(): ?string
    {
        return 'Distribusi sesuai status.';
    }


    protected function getData(): array
    {
        // Menghitung jumlah surat berdasarkan status
        $disposisi = SuratTransaksi::where('status_transaksi_surat', 'Disposisi')->count();
        $proses = SuratTransaksi::where('status_transaksi_surat', 'Proses')->count();
        $selesai = SuratTransaksi::where('status_transaksi_surat', 'Selesai')->count();

        // Labels dan Data untuk chart pie
        $labels = ['Disposisi', 'Proses', 'Selesai'];
        $data = [$disposisi, $proses, $selesai];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Surat',
                    'data' => $data,
                    'backgroundColor' => ['#ff6384', '#36a2eb', '#cc65fe'],
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
