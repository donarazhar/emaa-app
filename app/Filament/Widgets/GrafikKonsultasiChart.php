<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\LayananTransaksiKonsultasi;

class GrafikKonsultasiChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Layanan Konsultasi';
    protected int | string | array $columnSpan = 6;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Menghitung total konsultasi
        $totalKonsultasi = LayananTransaksiKonsultasi::count();

        // Menghitung jumlah konsultasi per jenis kelamin
        $pria = LayananTransaksiKonsultasi::where('jenkel_jamaah', 'Pria')->count();
        $wanita = LayananTransaksiKonsultasi::where('jenkel_jamaah', 'Wanita')->count();

        // Menghitung jumlah konsultasi per jenis konsultasi
        $jenisKonsultasiCounts = LayananTransaksiKonsultasi::select('jeniskonsultasi_id', DB::raw('count(*) as total'))
            ->groupBy('jeniskonsultasi_id')
            ->with('jeniskonsultasi')
            ->get()
            ->pluck('total', 'jeniskonsultasi.nama_jenis_konsultasi')->toArray();

        // Mengatur label dan data untuk chart
        $labels = array_merge(
            ['Total', 'Pria', 'Wanita'],
            array_keys($jenisKonsultasiCounts)
        );

        $data = array_merge(
            [$totalKonsultasi, $pria, $wanita],
            array_values($jenisKonsultasiCounts)
        );

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Konsultasi',
                    'data' => $data,
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#FF9F40', '#4BC0C0', '#9966FF', '#8E44AD'],
                ],
            ],
            'labels' => $labels,
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'tooltip' => [
                        'callbacks' => [
                            'label' => function ($tooltipItem) {
                                return $tooltipItem['label'] . ': ' . $tooltipItem['raw'] . ' Konsultasi';
                            },
                        ],
                    ],
                ],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
