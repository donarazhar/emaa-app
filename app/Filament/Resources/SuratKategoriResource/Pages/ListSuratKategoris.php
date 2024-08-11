<?php

namespace App\Filament\Resources\SuratKategoriResource\Pages;

use App\Filament\Resources\SuratKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratKategoris extends ListRecords
{
    protected static string $resource = SuratKategoriResource::class;
    protected static ?string $title = 'Data Tabel Kategori Surat';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Baru')->slideOver(),
        ];
    }
}
