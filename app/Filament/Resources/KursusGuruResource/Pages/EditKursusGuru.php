<?php

namespace App\Filament\Resources\KursusGuruResource\Pages;

use App\Filament\Resources\KursusGuruResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKursusGuru extends EditRecord
{
    protected static string $resource = KursusGuruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
