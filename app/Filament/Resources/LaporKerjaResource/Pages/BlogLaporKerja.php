<?php

namespace App\Filament\Resources\LaporKerjaResource\Pages;

use App\Filament\Resources\LaporKerjaResource;
use Filament\Resources\Pages\Page;
use Filament\Actions;

class BlogLaporKerja extends Page
{
    protected static string $resource = LaporKerjaResource::class;
    protected static ?string $title = 'Lapor Kerja';

    protected static string $view = 'filament.resources.lapor-kerja-resource.pages.blog-lapor-kerja';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
