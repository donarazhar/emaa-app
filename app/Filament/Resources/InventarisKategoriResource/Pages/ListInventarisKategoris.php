<?php

namespace App\Filament\Resources\InventarisKategoriResource\Pages;

use App\Filament\Resources\InventarisKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventarisKategoris extends ListRecords
{
    protected static string $resource = InventarisKategoriResource::class;
    protected static ?string $title = 'Data Kategori Inventaris';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Kategori Inventaris')->slideOver(),
        ];
    }
}
