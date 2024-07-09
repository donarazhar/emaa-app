<?php

namespace App\Filament\Resources\InventarisTransaksiResource\Pages;

use App\Filament\Resources\InventarisTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisTransaksis extends ListRecords
{
    protected static string $resource = InventarisTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
