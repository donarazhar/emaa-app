<?php

namespace App\Filament\Widgets;

use App\Models\Marbot;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class GrafikMarbotChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Marbot';
    protected int | string | array $columnSpan = 9;
    protected static ?string $maxHeight = '100%';
    protected static ?int $sort = 1;

    public function getDescription(): ?string
    {
        return 'Total marbot, Marbot berdasarkan usia, status menikah, jenis kelamin, serta status pegawai.';
    }

    protected function getData(): array
    {
        $marbots = Marbot::where('posisi', '!=', 'Mutasi')->get();

        // Menghitung jumlah marbot berdasarkan kategori
        $jumlahMarbot = $marbots->count();
        $usiaDiBawah30 = $marbots->filter(function ($marbot) {
            return Carbon::parse($marbot->tgl_lahir)->age < 30;
        })->count();
        $usiaDiAtas30 = $marbots->filter(function ($marbot) {
            return Carbon::parse($marbot->tgl_lahir)->age > 30;
        })->count();
        $usiaDiAtas40 = $marbots->filter(function ($marbot) {
            return Carbon::parse($marbot->tgl_lahir)->age > 40;
        })->count();
        $menikah = $marbots->where('status_nikah', 'Menikah')->count();
        $belumMenikah = $marbots->where('status_nikah', 'Belum Menikah')->count();
        $lakiLaki = $marbots->where('jenkel', 'Laki-Laki')->count();
        $perempuan = $marbots->where('jenkel', 'Perempuan')->count();
        $ktd = $marbots->where('status_pegawai', 'KTD')->count();
        $capeg = $marbots->where('status_pegawai', 'Capeg')->count();
        $kontrak = $marbots->where('status_pegawai', 'Kontrak')->count();
        $lepas = $marbots->where('status_pegawai', 'Lepas')->count();

        // Labels untuk sumbu Y
        $labels = [
            'Total Marbot',
            'Usia <30',
            'Usia >30',
            'Usia >40',
            'Menikah',
            'Belum Menikah',
            'Laki-laki',
            'Perempuan',
            'KTD',
            'Capeg',
            'Kontrak',
            'Lepas'
        ];

        // Data untuk sumbu X
        $data = [
            $jumlahMarbot,
            $usiaDiBawah30,
            $usiaDiAtas30,
            $usiaDiAtas40,
            $menikah,
            $belumMenikah,
            $lakiLaki,
            $perempuan,
            $ktd,
            $capeg,
            $kontrak,
            $lepas
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Marbot',
                    'data' => $data,
                    'backgroundColor' => '#ffde59',
                    'borderColor' => '#ffffff',
                    'barThickness' => 20,
                ],
            ],
            'labels' => $labels,
            'options' => [
                'indexAxis' => 'y',  // Membuat kategori menjadi sumbu Y
                'scales' => [
                    'x' => [
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
