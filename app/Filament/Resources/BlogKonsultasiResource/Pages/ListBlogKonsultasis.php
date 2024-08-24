<?php

namespace App\Filament\Resources\BlogKonsultasiResource\Pages;

use App\Filament\Resources\BlogKonsultasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogKonsultasis extends ListRecords
{
    protected static string $resource = BlogKonsultasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
