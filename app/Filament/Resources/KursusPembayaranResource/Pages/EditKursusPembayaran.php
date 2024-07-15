<?php

namespace App\Filament\Resources\KursusPembayaranResource\Pages;

use App\Filament\Resources\KursusPembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKursusPembayaran extends EditRecord
{
    protected static string $resource = KursusPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
