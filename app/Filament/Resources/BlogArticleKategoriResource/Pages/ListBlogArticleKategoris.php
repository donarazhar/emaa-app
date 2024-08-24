<?php

namespace App\Filament\Resources\BlogArticleKategoriResource\Pages;

use App\Filament\Resources\BlogArticleKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogArticleKategoris extends ListRecords
{
    protected static string $resource = BlogArticleKategoriResource::class;
    protected static ?string $title = 'List Kategori Artikel';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Kategori Baru')->slideOver(),
        ];
    }
}
