<?php

namespace App\Filament\Resources\BlogDonasiResource\Pages;

use App\Filament\Resources\BlogDonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogDonasis extends ListRecords
{
    protected static string $resource = BlogDonasiResource::class;
    protected static ?string $title = 'List Program Donasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Program Donasi Baru')->slideOver(),
        ];
    }
}
