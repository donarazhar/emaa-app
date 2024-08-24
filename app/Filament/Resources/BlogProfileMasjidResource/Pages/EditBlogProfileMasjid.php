<?php

namespace App\Filament\Resources\BlogProfileMasjidResource\Pages;

use App\Filament\Resources\BlogProfileMasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogProfileMasjid extends EditRecord
{
    protected static string $resource = BlogProfileMasjidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
