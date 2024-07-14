<?php

namespace App\Filament\Resources\KursusKategoriResource\Pages;

use App\Filament\Resources\KursusKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKursusKategori extends EditRecord
{
    protected static string $resource = KursusKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
