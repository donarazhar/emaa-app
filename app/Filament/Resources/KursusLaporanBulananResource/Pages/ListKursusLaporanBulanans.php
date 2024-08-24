<?php

namespace App\Filament\Resources\KursusLaporanBulananResource\Pages;

use App\Filament\Resources\KursusLaporanBulananResource;
use Filament\Resources\Pages\ListRecords;

class ListKursusLaporanBulanans extends ListRecords
{
    protected static string $resource = KursusLaporanBulananResource::class;
    protected static ?string $title = 'Laporan Bulanan Kursus';
}
