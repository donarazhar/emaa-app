<?php

namespace App\Filament\Resources\InventarisBagianResource\Pages;

use App\Filament\Resources\InventarisBagianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventarisBagian extends EditRecord
{
    protected static string $resource = InventarisBagianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
