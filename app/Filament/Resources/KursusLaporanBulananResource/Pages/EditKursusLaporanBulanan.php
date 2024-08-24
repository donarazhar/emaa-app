<?php

namespace App\Filament\Resources\KursusLaporanBulananResource\Pages;

use App\Filament\Resources\KursusLaporanBulananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKursusLaporanBulanan extends EditRecord
{
    protected static string $resource = KursusLaporanBulananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
