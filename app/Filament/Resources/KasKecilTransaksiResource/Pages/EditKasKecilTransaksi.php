<?php

namespace App\Filament\Resources\KasKecilTransaksiResource\Pages;

use App\Filament\Resources\KasKecilTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasKecilTransaksi extends EditRecord
{
    protected static string $resource = KasKecilTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
