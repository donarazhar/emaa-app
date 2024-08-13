<?php

namespace App\Filament\Resources\InventarisBagianResource\Pages;

use App\Filament\Resources\InventarisBagianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisBagians extends ListRecords
{
    protected static string $resource = InventarisBagianResource::class;
    protected static ?string $title = 'Data Bagian Inventaris';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Bagian Inventaris')->slideOver(),
        ];
    }
}
