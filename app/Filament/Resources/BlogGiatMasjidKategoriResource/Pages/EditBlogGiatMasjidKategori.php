<?php

namespace App\Filament\Resources\BlogGiatMasjidKategoriResource\Pages;

use App\Filament\Resources\BlogGiatMasjidKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogGiatMasjidKategori extends EditRecord
{
    protected static string $resource = BlogGiatMasjidKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
