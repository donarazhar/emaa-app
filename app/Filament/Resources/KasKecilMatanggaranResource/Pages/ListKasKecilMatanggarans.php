<?php

namespace App\Filament\Resources\KasKecilMatanggaranResource\Pages;

use App\Filament\Resources\KasKecilMatanggaranResource;
use App\Imports\ImportMatanggaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ListKasKecilMatanggarans extends ListRecords
{
    protected static string $resource = KasKecilMatanggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Buat Data Baru'),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make()->label('Buat Data Baru');
        return view('filament.resources.matanggaran.upload-file', compact('data'));
    }

    public $file = '';
    public function save()
    {
        if ($this->file != '') {
            Excel::import(new ImportMatanggaran, $this->file);
        }
    }
}
