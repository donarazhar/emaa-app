<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\LayananTransaksiPengislaman;

class GrafikPengislamanChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Layanan Pengislaman';
    protected int | string | array $columnSpan = 6;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Menghitung total pengislaman
        $totalPengislaman = LayananTransaksiPengislaman::count();

        // Menghitung jumlah pengislaman per kategori (WNI/WNA)
        $wni = LayananTransaksiPengislaman::where('kategori', 'WNI')->count();
        $wna = LayananTransaksiPengislaman::where('kategori', 'WNA')->count();

        // Menghitung jumlah pengislaman per jenis kelamin
        $pria = LayananTransaksiPengislaman::where('jenkel', 'Pria')->count();
        $wanita = LayananTransaksiPengislaman::where('jenkel', 'Wanita')->count();

        // Menghitung jumlah pengislaman per agama semula
        $agamaCounts = LayananTransaksiPengislaman::select('agama_semula', DB::raw('count(*) as total'))
            ->groupBy('agama_semula')
            ->get()
            ->pluck('total', 'agama_semula')->toArray();

        // Mengatur label dan data untuk chart
        $labels = array_merge(
            ['Total', 'WNI', 'WNA', 'Pria', 'Wanita'],
            array_keys($agamaCounts)
        );

        $data = array_merge(
            [$totalPengislaman, $wni, $wna, $pria, $wanita],
            array_values($agamaCounts)
        );

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengislaman',
                    'data' => $data,
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#FF9F40',
                        '#4BC0C0',
                        '#9966FF',
                        '#8E44AD',
                        '#27AE60',
                        '#2980B9',
                        '#F39C12',
                        '#C0392B',
                        '#2C3E50'
                    ],
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
                                return $tooltipItem['label'] . ': ' . $tooltipItem['raw'] . ' Pengislaman';
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
