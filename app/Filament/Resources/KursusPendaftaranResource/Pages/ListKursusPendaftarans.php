<?php

namespace App\Filament\Resources\KursusPendaftaranResource\Pages;

use App\Filament\Resources\KursusPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKursusPendaftarans extends ListRecords
{
    protected static string $resource = KursusPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
