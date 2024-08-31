<?php

namespace App\Filament\Resources\BlogBuletinResource\Pages;

use App\Filament\Resources\BlogBuletinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogBuletin extends EditRecord
{
    protected static string $resource = BlogBuletinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
