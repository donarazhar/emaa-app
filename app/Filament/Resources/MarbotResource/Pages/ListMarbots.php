<?php

namespace App\Filament\Resources\MarbotResource\Pages;

use App\Filament\Resources\MarbotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListMarbots extends ListRecords
{
    protected static string $resource = MarbotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
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
        'KTD' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pegawai', 'KTD')),
        'Kontrak' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pegawai', 'Kontrak')),
        'Capeg' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status_pegawai', 'Capeg')),
    ];
}
}
