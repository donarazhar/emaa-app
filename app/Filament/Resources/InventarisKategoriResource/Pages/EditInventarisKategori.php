<?php

namespace App\Filament\Resources\InventarisKategoriResource\Pages;

use App\Filament\Resources\InventarisKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventarisKategori extends EditRecord
{
    protected static string $resource = InventarisKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
