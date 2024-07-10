<?php

namespace App\Filament\Resources\LaporKerjaResource\Pages;

use App\Filament\Resources\LaporKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporKerjas extends ListRecords
{
    protected static string $resource = LaporKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
