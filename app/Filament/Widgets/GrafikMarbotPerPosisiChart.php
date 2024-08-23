<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\Marbot; // Pastikan model Marbot sudah ada dan digunakan

class GrafikMarbotPerPosisiChart extends ChartWidget
{
    protected static ?string $heading = 'Marbot Per Posisi';
    protected int | string | array $columnSpan = 3;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 1;

    public function getDescription(): ?string
    {
        return 'Marbot sesuai posisi yang ada.';
    }

    protected function getData(): array
    {
        // Menghitung jumlah Marbot berdasarkan posisi
        $data = Marbot::select('posisi', DB::raw('count(*) as total'))
            ->groupBy('posisi')
            ->get();

        // Mengambil label dan data untuk chart
        $labels = $data->pluck('posisi')->toArray();
        $values = $data->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Marbot',
                    'data' => $values,
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#FF9F40', '#4BC0C0', '#9966FF'],
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
                                return $tooltipItem['label'] . ': ' . $tooltipItem['raw'] . ' Marbot';
                            },
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
