<?php

namespace App\Filament\Resources\InventarisPenyusutanResource\Pages;

use App\Filament\Resources\InventarisPenyusutanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventarisPenyusutan extends EditRecord
{
    protected static string $resource = InventarisPenyusutanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
