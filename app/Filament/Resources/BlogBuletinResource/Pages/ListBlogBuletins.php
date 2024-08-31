<?php

namespace App\Filament\Resources\BlogBuletinResource\Pages;

use App\Filament\Resources\BlogBuletinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogBuletins extends ListRecords
{
    protected static string $resource = BlogBuletinResource::class;
    protected static ?string $title = 'List Buletin Jumat';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Buletin Baru')->slideOver(),
        ];
    }
}
