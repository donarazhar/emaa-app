<?php

namespace App\Filament\Resources\BlogGiatMasjidKategoriResource\Pages;

use App\Filament\Resources\BlogGiatMasjidKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogGiatMasjidKategoris extends ListRecords
{
    protected static string $resource = BlogGiatMasjidKategoriResource::class;
    protected static ?string $title = 'List Kategori Giat Masjid';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Kategori Baru')->slideOver(),
        ];
    }
}
