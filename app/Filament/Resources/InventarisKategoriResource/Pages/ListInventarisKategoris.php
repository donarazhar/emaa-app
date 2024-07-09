<?php

namespace App\Filament\Resources\InventarisKategoriResource\Pages;

use App\Filament\Resources\InventarisKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisKategoris extends ListRecords
{
    protected static string $resource = InventarisKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
