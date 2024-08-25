<?php

namespace App\Filament\Resources\BlogGiatMasjidResource\Pages;

use App\Filament\Resources\BlogGiatMasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogGiatMasjids extends ListRecords
{
    protected static string $resource = BlogGiatMasjidResource::class;
    protected static ?string $title = 'List Giat Masjid';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Giat Baru')->slideOver(),
        ];
    }
}
