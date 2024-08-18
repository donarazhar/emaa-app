<?php

namespace App\Filament\Resources\InventarisSuplierResource\Pages;

use App\Filament\Resources\InventarisSuplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisSupliers extends ListRecords
{
    protected static string $resource = InventarisSuplierResource::class;
    protected static ?string $title = 'Data Suplier';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Suplier')->slideOver(),
        ];
    }
}
