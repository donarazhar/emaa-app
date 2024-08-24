<?php

namespace App\Filament\Resources\BlogBannerResource\Pages;

use App\Filament\Resources\BlogBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogBanner extends CreateRecord
{
    protected static string $resource = BlogBannerResource::class;
}
