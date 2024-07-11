<?php

namespace App\Filament\Resources\MarbotResource\Pages;

use App\Filament\Resources\MarbotResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMarbot extends CreateRecord
{
    protected static string $resource = MarbotResource::class;

    protected function getRedirectUrl(): string
    {
        // Mengubah redirect ketika sudah menyimpan
        return route('filament.admin.resources.marbots.index');
    }
}
