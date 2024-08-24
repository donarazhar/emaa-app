<?php

namespace App\Filament\Resources\BlogKonsultasiResource\Pages;

use App\Filament\Resources\BlogKonsultasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogKonsultasi extends EditRecord
{
    protected static string $resource = BlogKonsultasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
