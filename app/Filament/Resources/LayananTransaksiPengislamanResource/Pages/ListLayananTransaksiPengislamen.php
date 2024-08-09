<?php

namespace App\Filament\Resources\LayananTransaksiPengislamanResource\Pages;

use App\Filament\Resources\LayananTransaksiPengislamanResource;
use App\Models\LayananTransaksiPengislaman;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLayananTransaksiPengislamen extends ListRecords
{
    protected static string $resource = LayananTransaksiPengislamanResource::class;
    protected static ?string $title = 'Data Tabel Pengislaman';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Buat Jadwal Pengislaman'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        // Menampilkan datatabel OrderyByDesc
        return parent::getTableQuery()->orderByDesc('id');
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl', '>=', now()->subWeek()))
                ->badge(LayananTransaksiPengislaman::query()->where('tgl', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl', '>=', now()->subMonth()))
                ->badge(LayananTransaksiPengislaman::query()->where('tgl', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl', '>=', now()->subYear()))
                ->badge(LayananTransaksiPengislaman::query()->where('tgl', '>=', now()->subYear())->count()),

        ];
    }
}
