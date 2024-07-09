<?php

namespace App\Filament\Resources\SuratTransaksiResource\Pages;

use App\Filament\Resources\SuratTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuratTransaksi extends EditRecord
{
    protected static string $resource = SuratTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
