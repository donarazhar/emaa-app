<?php

namespace App\Filament\Resources\LayananTransaksiPengislamanResource\Pages;

use App\Filament\Resources\LayananTransaksiPengislamanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananTransaksiPengislamen extends ListRecords
{
    protected static string $resource = LayananTransaksiPengislamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
