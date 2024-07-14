<?php

namespace App\Filament\Resources\KursusKategoriResource\Pages;

use App\Filament\Resources\KursusKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKursusKategoris extends ListRecords
{
    protected static string $resource = KursusKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
