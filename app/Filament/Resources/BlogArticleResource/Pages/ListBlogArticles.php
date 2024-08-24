<?php

namespace App\Filament\Resources\BlogArticleResource\Pages;

use App\Filament\Resources\BlogArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogArticles extends ListRecords
{
    protected static string $resource = BlogArticleResource::class;
    protected static ?string $title = 'List Artikel';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Artikel Baru')->slideOver(),
        ];
    }
}
