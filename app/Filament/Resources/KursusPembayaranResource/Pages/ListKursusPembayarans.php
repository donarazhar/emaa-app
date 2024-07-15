<?php

namespace App\Filament\Resources\KursusPembayaranResource\Pages;

use App\Filament\Resources\KursusPembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKursusPembayarans extends ListRecords
{
    protected static string $resource = KursusPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
