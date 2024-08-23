<?php

namespace App\Filament\Resources\KursusPendaftaranResource\Pages;

use App\Filament\Resources\KursusPendaftaranResource;
use App\Models\KursusPendaftaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListKursusPendaftarans extends ListRecords
{
    protected static string $resource = KursusPendaftaranResource::class;
    protected static ?string $title = 'Data Transaksi Pendaftaran';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Pendaftaran')->slideOver(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tanggal', '>=', now()->subWeek()))
                ->badge(KursusPendaftaran::query()->where('tanggal', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tanggal', '>=', now()->subMonth()))
                ->badge(KursusPendaftaran::query()->where('tanggal', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tanggal', '>=', now()->subYear()))
                ->badge(KursusPendaftaran::query()->where('tanggal', '>=', now()->subYear())->count()),
            'Reguler' => Tab::make()
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->whereHas('jadwal.kategori', function (Builder $query) {
                        $query->where('jenis_kursus', 'reguler');
                    })
                )
                ->badge(KursusPendaftaran::whereHas('jadwal.kategori', function (Builder $query) {
                    $query->where('jenis_kursus', 'reguler');
                })->count()),
            'Private' => Tab::make()
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->whereHas('jadwal.kategori', function (Builder $query) {
                        $query->where('jenis_kursus', 'private');
                    })
                )
                ->badge(KursusPendaftaran::whereHas('jadwal.kategori', function (Builder $query) {
                    $query->where('jenis_kursus', 'private');
                })->count()),

        ];
    }
}
