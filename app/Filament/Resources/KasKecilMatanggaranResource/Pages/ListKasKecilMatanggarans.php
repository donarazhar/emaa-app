<?php

namespace App\Filament\Resources\KasKecilMatanggaranResource\Pages;

use App\Filament\Resources\KasKecilMatanggaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKasKecilMatanggarans extends ListRecords
{
    protected static string $resource = KasKecilMatanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
