<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\InventarisTransaksi;

class GrafikInventarisChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Inventaris';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 8;

    public function getDescription(): ?string
    {
        return 'Menampilkan laporan pengeluaran kas kecil.';
    }

    protected function getData(): array
    {
        // Menghitung total semua barang inventaris
        $totalInventaris = InventarisTransaksi::count();

        // Menghitung total inventaris berdasarkan jenis transaksi
        $dataJenisTransaksi = InventarisTransaksi::select('jenis_transaksi', DB::raw('count(*) as total'))
            ->groupBy('jenis_transaksi')
            ->get()
            ->pluck('total', 'jenis_transaksi')
            ->toArray();

        // Menghitung total inventaris berdasarkan status
        $dataStatus = InventarisTransaksi::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        // Menyusun data untuk chart
        $labels = ['Total Inventaris', 'Masuk', 'Keluar', 'Pindah', 'Baik', 'Rusak', 'Repair'];

        $data = [
            $totalInventaris,  // Total semua barang inventaris
            $dataJenisTransaksi['masuk'] ?? 0,
            $dataJenisTransaksi['keluar'] ?? 0,
            $dataJenisTransaksi['pindah'] ?? 0,
            $dataStatus['baik'] ?? 0,
            $dataStatus['rusak'] ?? 0,
            $dataStatus['repair'] ?? 0,
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Inventaris',
                    'data' => $data,
                    'backgroundColor' => [
                        '#FF6384', // Total
                        '#36A2EB', // Masuk
                        '#FFCE56', // Keluar
                        '#FF9F40', // Pindah
                        '#4BC0C0', // Baik
                        '#9966FF', // Rusak
                        '#C0392B'  // Repair
                    ],
                    'borderColor' => '#ffffff',
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
                                return $tooltipItem['label'] . ': ' . number_format($tooltipItem['raw'], 0, ',', '.') . ' Inventaris';
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
