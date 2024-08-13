<?php

namespace App\Filament\Resources\InventarisMerkResource\Pages;

use App\Filament\Resources\InventarisMerkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisMerks extends ListRecords
{
    protected static string $resource = InventarisMerkResource::class;
    protected static ?string $title = 'Data Merk Barang';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Merk Barang')->slideOver(),
        ];
    }
}
