<?php

namespace App\Filament\Resources\KasKecilTransaksiResource\Pages;

use Filament\Actions;
use App\Models\KasKecilTransaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Resources\Components\Tab;
use App\Imports\ImportTransaksiKasKecil;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KasKecilTransaksiResource;


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

    protected function getTableQuery(): Builder
    {
        // Menampilkan datatabel OrderyByDesc
        return parent::getTableQuery()->orderBy('tgl_transaksi');
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->whereBetween('tgl_transaksi', [now()->startOfMonth(), now()->endOfMonth()]))
                ->badge(KasKecilTransaksi::query()->whereBetween('tgl_transaksi', [now()->startOfMonth(), now()->endOfMonth()])->count()),


        ];
    }
}
