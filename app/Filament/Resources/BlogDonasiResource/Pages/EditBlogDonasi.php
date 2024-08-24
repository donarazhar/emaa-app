<?php

namespace App\Filament\Resources\BlogDonasiResource\Pages;

use App\Filament\Resources\BlogDonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogDonasi extends EditRecord
{
    protected static string $resource = BlogDonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
