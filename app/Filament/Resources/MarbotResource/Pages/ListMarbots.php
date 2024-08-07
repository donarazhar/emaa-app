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
    protected static ?string $title = 'Data Tabel Marbot';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Data Baru Marbot'),
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
            'Staf TU' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('posisi', 'Staf')),
            'Kebersihan' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('posisi', 'Kebersihan')),
            'Teknisi' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('posisi', 'Teknisi')),
            'Imam Muazin' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('posisi', 'Imammuazin')),
            'Lepas' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('posisi', 'Lepas')),
        ];
    }
}
