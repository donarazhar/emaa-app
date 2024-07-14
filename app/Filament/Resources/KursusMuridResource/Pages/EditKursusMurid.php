<?php

namespace App\Filament\Resources\KursusMuridResource\Pages;

use App\Filament\Resources\KursusMuridResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKursusMurid extends EditRecord
{
    protected static string $resource = KursusMuridResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
