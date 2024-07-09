<?php

namespace App\Filament\Resources\InventarisMerkResource\Pages;

use App\Filament\Resources\InventarisMerkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventarisMerk extends EditRecord
{
    protected static string $resource = InventarisMerkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
