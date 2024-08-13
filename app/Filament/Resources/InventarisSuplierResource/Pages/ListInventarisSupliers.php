<?php

namespace App\Filament\Resources\InventarisSuplierResource\Pages;

use App\Filament\Resources\InventarisSuplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisSupliers extends ListRecords
{
    protected static string $resource = InventarisSuplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
