<?php

namespace App\Filament\Resources\KasKecilAasResource\Pages;

use App\Filament\Resources\KasKecilAasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasKecilAas extends EditRecord
{
    protected static string $resource = KasKecilAasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
