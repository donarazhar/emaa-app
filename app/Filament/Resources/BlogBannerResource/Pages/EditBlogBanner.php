<?php

namespace App\Filament\Resources\BlogBannerResource\Pages;

use App\Filament\Resources\BlogBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogBanner extends EditRecord
{
    protected static string $resource = BlogBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
