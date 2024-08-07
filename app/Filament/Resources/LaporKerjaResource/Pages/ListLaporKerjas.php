<?php

namespace App\Filament\Resources\LaporKerjaResource\Pages;

use App\Filament\Resources\LaporKerjaResource;
use App\Models\LaporKerja;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListLaporKerjas extends ListRecords
{
    protected static string $resource = LaporKerjaResource::class;
    protected static ?string $title = 'Data Tabel Lapor Kerja';

    protected function getTableQuery(): Builder
    {
        // Menampilkan datatabel OrderyByDesc
        return parent::getTableQuery()->orderByDesc('id');
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Lapor Kerja'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl', '>=', now()->subWeek()))
                ->badge(LaporKerja::query()->where('tgl', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl', '>=', now()->subMonth()))
                ->badge(LaporKerja::query()->where('tgl', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('tgl', '>=', now()->subYear()))
                ->badge(LaporKerja::query()->where('tgl', '>=', now()->subYear())->count()),

        ];
    }
}
