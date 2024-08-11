<?php

namespace App\Filament\Resources\SuratAsalResource\Pages;

use App\Filament\Resources\SuratAsalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratAsals extends ListRecords
{
    protected static string $resource = SuratAsalResource::class;
    protected static ?string $title = 'Data Tabel Asal Surat';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Baru')->slideOver(),
        ];
    }
}
