<?php

namespace App\Filament\Resources\KursusMuridResource\Pages;

use App\Filament\Resources\KursusMuridResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKursusMurids extends ListRecords
{
    protected static string $resource = KursusMuridResource::class;
    protected static ?string $title = 'Data Tabel Murid';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Murid')->slideOver(),
        ];
    }
}
