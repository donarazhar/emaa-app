<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SuratTransaksi;

class GrafikPersuratanByTimeChart extends ChartWidget
{
    protected static ?string $heading = 'Surat Per Waktu';
    protected int | string | array $columnSpan = 3;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 3;

    public function getDescription(): ?string
    {
        return 'Distribusi sesuai waktu.';
    }

    protected function getData(): array
    {
        // Menghitung jumlah surat per hari
        $perhari = SuratTransaksi::selectRaw('DATE(tgl_transaksi_surat) as tanggal, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->get()
            ->sum('jumlah');

        // Menghitung jumlah surat per bulan
        $perbulan = SuratTransaksi::selectRaw('DATE_FORMAT(tgl_transaksi_surat, "%Y-%m") as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->get()
            ->sum('jumlah');

        // Menghitung jumlah surat per tahun
        $pertahun = SuratTransaksi::selectRaw('YEAR(tgl_transaksi_surat) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->get()
            ->sum('jumlah');

        // Labels dan Data untuk chart pie
        $labels = ['Per Hari', 'Per Bulan', 'Per Tahun'];
        $data = [$perhari, $perbulan, $pertahun];

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
