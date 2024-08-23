<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\KasKecilTransaksi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class GrafikPengisianKasChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pengisian Kas kecil';
    protected int | string | array $columnSpan = 3;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 7;

    protected function getData(): array
    {
        // Periode waktu yang dibutuhkan (tahun ini)
        $currentYear = Carbon::now()->format('Y');

        // Menghitung total pengisian per kategori selama setahun
        $pengisianData = KasKecilTransaksi::select(DB::raw('SUM(jumlah) as total'), 'kode_matanggaran')
            ->where('kategori', 'pengisian')
            ->where(DB::raw('YEAR(tgl_transaksi)'), $currentYear)
            ->groupBy('kode_matanggaran')
            ->with(['matanggaran' => function ($query) {
                $query->with('aas');
            }])
            ->get()
            ->pluck('total', 'matanggaran.aas.nama_aas')
            ->toArray();

        // Menyiapkan label dan data untuk pie chart
        $labels = array_keys($pengisianData);
        $data = array_values($pengisianData);

        return [
            'datasets' => [
                [
                    'label' => 'Total Pengisian',
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
                                return $tooltipItem['label'] . ': ' . number_format($tooltipItem['raw'], 0, ',', '.') . ' Rupiah';
                            },
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
