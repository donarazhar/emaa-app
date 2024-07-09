<?php

namespace App\Filament\Resources\InventarisTransaksiResource\Pages;

use App\Filament\Resources\InventarisTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventarisTransaksi extends EditRecord
{
    protected static string $resource = InventarisTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
