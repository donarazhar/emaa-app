<?php

namespace App\Filament\Resources\KursusJadwalResource\Pages;

use App\Filament\Resources\KursusJadwalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKursusJadwals extends ListRecords
{
    protected static string $resource = KursusJadwalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
