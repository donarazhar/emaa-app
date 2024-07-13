<?php

namespace App\Filament\Resources\KasKecilMatanggaranResource\Pages;

use App\Filament\Resources\KasKecilMatanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasKecilMatanggaran extends EditRecord
{
    protected static string $resource = KasKecilMatanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
