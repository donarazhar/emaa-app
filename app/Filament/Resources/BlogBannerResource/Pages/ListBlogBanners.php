<?php

namespace App\Filament\Resources\BlogBannerResource\Pages;

use App\Filament\Resources\BlogBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogBanners extends ListRecords
{
    protected static string $resource = BlogBannerResource::class;
    protected static ?string $title = 'List Banner';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Banner Baru')->slideOver(),
        ];
    }
}
