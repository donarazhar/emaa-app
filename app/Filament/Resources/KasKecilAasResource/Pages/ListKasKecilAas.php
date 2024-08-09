<?php

namespace App\Filament\Resources\KasKecilAasResource\Pages;

use App\Filament\Resources\KasKecilAasResource;
use App\Imports\ImportAas;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;



class ListKasKecilAas extends ListRecords
{
    protected static string $resource = KasKecilAasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Buat Data Baru'),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make()->label('Buat Data Baru');
        return view('filament.resources.aas.upload-file', compact('data'));
    }

    public $file = '';
    public function save()
    {
        if ($this->file != '') {
            Excel::import(new ImportAas, $this->file);
        }
    }
}
