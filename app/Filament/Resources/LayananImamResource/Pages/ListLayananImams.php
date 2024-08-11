<?php

namespace App\Filament\Resources\LayananImamResource\Pages;

use App\Filament\Resources\LayananImamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananImams extends ListRecords
{
    protected static string $resource = LayananImamResource::class;
    protected static ?string $title = 'Data Tabel Imam';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Buat Data Imam'),
        ];
    }
}
