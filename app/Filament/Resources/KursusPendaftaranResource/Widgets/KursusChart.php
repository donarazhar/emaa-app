<?php

namespace App\Filament\Resources\KursusPendaftaranResource\Widgets;

use Filament\Widgets\ChartWidget;

class KursusChart extends ChartWidget
{
    protected static ?string $heading = 'Data Kursus';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Data Pendaftaran Kursus',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
