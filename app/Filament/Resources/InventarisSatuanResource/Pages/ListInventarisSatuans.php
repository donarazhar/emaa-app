<?php

namespace App\Filament\Resources\InventarisSatuanResource\Pages;

use App\Filament\Resources\InventarisSatuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisSatuans extends ListRecords
{
    protected static string $resource = InventarisSatuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
