<?php

namespace App\Filament\Resources\KasKecilAasResource\Pages;

use App\Filament\Resources\KasKecilAasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKasKecilAas extends ListRecords
{
    protected static string $resource = KasKecilAasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
