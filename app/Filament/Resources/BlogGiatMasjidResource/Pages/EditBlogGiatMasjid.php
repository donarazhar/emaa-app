<?php

namespace App\Filament\Resources\BlogGiatMasjidResource\Pages;

use App\Filament\Resources\BlogGiatMasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogGiatMasjid extends EditRecord
{
    protected static string $resource = BlogGiatMasjidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
