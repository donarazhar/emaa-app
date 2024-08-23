<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\KasKecilTransaksi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class GrafikPengeluaranKasChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pengeluaran Kas kecil';
    protected int | string | array $columnSpan = 9;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 7;

    public function getDescription(): ?string
    {
        return 'Menampilkan laporan pengeluaran kas kecil.';
    }


    protected function getData(): array
    {
        // Periode waktu yang dibutuhkan
        $currentMonth = Carbon::now()->format('Y-m');
        $currentYear = Carbon::now()->format('Y');

        // Menghitung total pengeluaran selama bulan berjalan
        $monthlyUsage = KasKecilTransaksi::select(DB::raw('SUM(jumlah) as total'), 'kode_matanggaran')
            ->where('kategori', 'pengeluaran')
            ->where(DB::raw('DATE_FORMAT(tgl_transaksi, "%Y-%m")'), $currentMonth)
            ->groupBy('kode_matanggaran')
            ->with(['matanggaran' => function ($query) {
                $query->with('aas');
            }])
            ->get()
            ->pluck('total', 'matanggaran.aas.nama_aas')
            ->toArray();

        // Menghitung total pengeluaran selama setahun
        $yearlyUsage = KasKecilTransaksi::select(DB::raw('SUM(jumlah) as total'), 'kode_matanggaran')
            ->where('kategori', 'pengeluaran')
            ->where(DB::raw('YEAR(tgl_transaksi)'), $currentYear)
            ->groupBy('kode_matanggaran')
            ->with(['matanggaran' => function ($query) {
                $query->with('aas');
            }])
            ->get()
            ->pluck('total', 'matanggaran.aas.nama_aas')
            ->toArray();

        // Menghitung total pengeluaran tahunan
        $totalYearlyExpense = array_sum($yearlyUsage);

        // Menggabungkan data bulanan dan tahunan ke dalam format untuk chart
        $labels = array_keys(array_merge($monthlyUsage, $yearlyUsage));
        $monthlyData = [];
        $yearlyData = [];

        foreach ($labels as $label) {
            $monthlyData[] = $monthlyUsage[$label] ?? 0;
            $yearlyData[] = $yearlyUsage[$label] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Bulan Ini',
                    'data' => $monthlyData,
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#36A2EB',
                    'fill' => false,
                ],
                [
                    'label' => 'Total Tahun Ini',
                    'data' => $yearlyData,
                    'borderColor' => '#FF6384',
                    'backgroundColor' => '#FF6384',
                    'fill' => false,
                ],
                [
                    'label' => 'Total Pengeluaran Tahun Ini',
                    'data' => array_fill(0, count($labels), $totalYearlyExpense),
                    'borderColor' => '#4BC0C0',
                    'backgroundColor' => '#4BC0C0',
                    'fill' => false,
                    'borderDash' => [5, 5],
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
                                return $tooltipItem['dataset']['label'] . ': ' . number_format($tooltipItem['raw'], 0, ',', '.') . ' Rupiah';
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
        return 'line';
    }
}
