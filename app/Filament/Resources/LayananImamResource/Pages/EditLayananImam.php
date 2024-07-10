<?php

namespace App\Filament\Resources\LayananImamResource\Pages;

use App\Filament\Resources\LayananImamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayananImam extends EditRecord
{
    protected static string $resource = LayananImamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
