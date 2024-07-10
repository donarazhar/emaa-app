<?php

namespace App\Filament\Resources\LayananTransaksiKonsultasiResource\Pages;

use App\Filament\Resources\LayananTransaksiKonsultasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayananTransaksiKonsultasi extends EditRecord
{
    protected static string $resource = LayananTransaksiKonsultasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
