<?php

namespace App\Filament\Resources\LayananTransaksiKonsultasiResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\LayananTransaksiKonsultasiResource;
use App\Models\LayananTransaksiKonsultasi;

class ListLayananTransaksiKonsultasis extends ListRecords
{
    protected static string $resource = LayananTransaksiKonsultasiResource::class;
    protected static ?string $title = 'Data Tabel Konsultasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver()->label('Buat Jadwal Konsultasi'),
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
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl_booking', '>=', now()->subWeek()))
                ->badge(LayananTransaksiKonsultasi::query()->where('tgl_booking', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl_booking', '>=', now()->subMonth()))
                ->badge(LayananTransaksiKonsultasi::query()->where('tgl_booking', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl_booking', '>=', now()->subYear()))
                ->badge(LayananTransaksiKonsultasi::query()->where('tgl_booking', '>=', now()->subYear())->count()),

        ];
    }
}
