<?php

namespace App\Filament\Resources\InventarisSatuanResource\Pages;

use App\Filament\Resources\InventarisSatuanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventarisSatuan extends EditRecord
{
    protected static string $resource = InventarisSatuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
