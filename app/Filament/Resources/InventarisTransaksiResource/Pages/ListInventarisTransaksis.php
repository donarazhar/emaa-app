<?php

namespace App\Filament\Resources\InventarisTransaksiResource\Pages;

use App\Filament\Resources\InventarisTransaksiResource;
use App\Models\InventarisTransaksi;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListInventarisTransaksis extends ListRecords
{
    protected static string $resource = InventarisTransaksiResource::class;
    protected static ?string $title = 'Data Tabel Inventaris';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Inventaris')->slideOver(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tgl_data_inventaris', '>=', now()->subWeek()))
                ->badge(InventarisTransaksi::query()->where('tgl_data_inventaris', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tgl_data_inventaris', '>=', now()->subMonth()))
                ->badge(InventarisTransaksi::query()->where('tgl_data_inventaris', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tgl_data_inventaris', '>=', now()->subYear()))
                ->badge(InventarisTransaksi::query()->where('tgl_data_inventaris', '>=', now()->subYear())->count()),

        ];
    }
}
