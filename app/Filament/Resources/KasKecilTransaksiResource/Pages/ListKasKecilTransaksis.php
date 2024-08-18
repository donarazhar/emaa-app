<?php

namespace App\Filament\Resources\KasKecilTransaksiResource\Pages;

use Filament\Actions;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportTransaksiKasKecil;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\KasKecilPembentukan;
use App\Filament\Resources\KasKecilTransaksiResource;
use App\Filament\Resources\MarbotResource\Widgets\StatsOverview;
use App\Filament\Widgets\KasKecilStats;

class ListKasKecilTransaksis extends ListRecords
{
    protected static string $resource = KasKecilTransaksiResource::class;
    protected static ?string $title = 'Pengeluaran Kas Kecil';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Tambah Data Pengeluaran'),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            KasKecilStats::class,
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make()->label('Tambah Data Pengeluaran');
        return view('filament.resources.transaksikaskecil.upload-file', compact('data'));
    }

    public $file = '';
    public function save()
    {
        if ($this->file != '') {
            Excel::import(new ImportTransaksiKasKecil, $this->file);
        }
    }
}
