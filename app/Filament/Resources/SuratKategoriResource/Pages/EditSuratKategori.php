<?php

namespace App\Filament\Resources\SuratKategoriResource\Pages;

use App\Filament\Resources\SuratKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuratKategori extends EditRecord
{
    protected static string $resource = SuratKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
