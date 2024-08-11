<?php

namespace App\Filament\Resources\LayananJenisKonsultasiResource\Pages;

use App\Filament\Resources\LayananJenisKonsultasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananJenisKonsultasis extends ListRecords
{
    protected static string $resource = LayananJenisKonsultasiResource::class;
    protected static ?string $title = 'Data Tabel Jenis Konsultasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Buat Data Jenis Konsultasi'),
        ];
    }
}
