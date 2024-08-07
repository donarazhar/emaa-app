<?php

namespace App\Filament\Resources\LaporKerjaResource\Pages;

use App\Filament\Resources\LaporKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporKerja extends CreateRecord
{
    protected static string $resource = LaporKerjaResource::class;
    protected static ?string $title = 'Buat Lapor Kerja';

    protected function getRedirectUrl(): string
    {
        // Mengubah redirect ketika sudah menyimpan
        return route('filament.admin.resources.lapor-kerjas.index');
    }
}
