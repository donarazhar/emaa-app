<?php

namespace App\Filament\Resources\BlogArticleKategoriResource\Pages;

use App\Filament\Resources\BlogArticleKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogArticleKategori extends EditRecord
{
    protected static string $resource = BlogArticleKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
