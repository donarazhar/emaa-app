<?php

namespace App\Filament\Resources\LaporKerjaResource\Pages;

use App\Filament\Resources\LaporKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporKerja extends EditRecord
{
    protected static string $resource = LaporKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
