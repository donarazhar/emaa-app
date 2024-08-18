<?php

namespace App\Filament\Resources\InventarisPenyusutanResource\Pages;

use App\Filament\Resources\InventarisPenyusutanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisPenyusutans extends ListRecords
{
    protected static string $resource = InventarisPenyusutanResource::class;
    protected static ?string $title = 'Data Penyusutan Barang';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Penyusutan')->slideOver(),
        ];
    }
}
