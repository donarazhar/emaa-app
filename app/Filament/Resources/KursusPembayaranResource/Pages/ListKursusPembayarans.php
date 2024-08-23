<?php

namespace App\Filament\Resources\KursusPembayaranResource\Pages;

use App\Filament\Resources\KursusPembayaranResource;
use App\Models\KursusPembayaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListKursusPembayarans extends ListRecords
{
    protected static string $resource = KursusPembayaranResource::class;
    protected static ?string $title = 'Data Transaksi Pembayaran';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Data Pembayaran')->slideOver(),
        ];
    }


    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tanggal', '>=', now()->subWeek()))
                ->badge(KursusPembayaran::query()->where('tanggal', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tanggal', '>=', now()->subMonth()))
                ->badge(KursusPembayaran::query()->where('tanggal', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('tanggal', '>=', now()->subYear()))
                ->badge(KursusPembayaran::query()->where('tanggal', '>=', now()->subYear())->count()),
            'Reguler' => Tab::make()
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->whereHas('pendaftaran.jadwal.kategori', function (Builder $query) {
                        $query->where('jenis_kursus', 'reguler');
                    })
                )
                ->badge(KursusPembayaran::whereHas('pendaftaran.jadwal.kategori', function (Builder $query) {
                    $query->where('jenis_kursus', 'reguler');
                })->count()),
            'Private' => Tab::make()
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->whereHas('pendaftaran.jadwal.kategori', function (Builder $query) {
                        $query->where('jenis_kursus', 'private');
                    })
                )
                ->badge(KursusPembayaran::whereHas('pendaftaran.jadwal.kategori', function (Builder $query) {
                    $query->where('jenis_kursus', 'private');
                })->count()),

        ];
    }
}
