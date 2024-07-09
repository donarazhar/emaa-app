<?php

namespace App\Filament\Resources\SuratAsalResource\Pages;

use App\Filament\Resources\SuratAsalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuratAsal extends EditRecord
{
    protected static string $resource = SuratAsalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
