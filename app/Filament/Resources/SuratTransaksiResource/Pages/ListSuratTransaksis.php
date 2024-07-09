<?php

namespace App\Filament\Resources\SuratTransaksiResource\Pages;

use App\Filament\Resources\SuratTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratTransaksis extends ListRecords
{
    protected static string $resource = SuratTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
