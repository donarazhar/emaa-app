<?php

namespace App\Filament\Resources\SuratTransaksiResource\Pages;

use App\Filament\Resources\SuratTransaksiResource;
use App\Imports\ImportPersuratans;
use App\Models\SuratTransaksi;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSuratTransaksis extends ListRecords
{
    protected static string $resource = SuratTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $data = Actions\CreateAction::make()->label('New Data Persuratan');
        return view('filament.resources.persuratan.upload-surat', compact('data'));
    }

    public $file = '';
    public function save()
    {
        if ($this->file != '') {
            Excel::import(new ImportPersuratans, $this->file);
        }
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl_transaksi_surat', '>=', now()->subWeek()))
                ->badge(SuratTransaksi::query()->where('tgl_transaksi_surat', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl_transaksi_surat', '>=', now()->subMonth()))
                ->badge(SuratTransaksi::query()->where('tgl_transaksi_surat', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl_transaksi_surat', '>=', now()->subYear()))
                ->badge(SuratTransaksi::query()->where('tgl_transaksi_surat', '>=', now()->subYear())->count()),

        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->orderBy('id', 'desc');
    }
}
