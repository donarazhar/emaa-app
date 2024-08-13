<?php

namespace App\Filament\Resources\InventarisPenyusutanResource\Pages;

use App\Filament\Resources\InventarisPenyusutanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisPenyusutans extends ListRecords
{
    protected static string $resource = InventarisPenyusutanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
