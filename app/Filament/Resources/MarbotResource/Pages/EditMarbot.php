<?php

namespace App\Filament\Resources\MarbotResource\Pages;

use App\Filament\Resources\MarbotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarbot extends EditRecord
{
    protected static string $resource = MarbotResource::class;
    protected static ?string $title = 'Update Data Marbot';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
