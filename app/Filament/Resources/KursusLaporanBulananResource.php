<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KursusKategori;
use Filament\Resources\Resource;
use App\Models\KursusPembayaran;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KursusLaporanBulananResource\Pages;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KursusLaporanBulananResource extends Resource
{
    protected static ?string $model = KursusPembayaran::class;

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Laporan Bulanan';
    protected static ?string $navigationLabel = 'Laporan Bulanan';
    protected static ?string $navigationParentItem = 'Transaksi Bayar';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No.')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tgl. Transaksi')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('pendaftaran.murid.nama')
                    ->label('Nama Murid')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('pendaftaran.jadwal.kategori.jenis_kursus')
                    ->label('Jenis Kursus')
                    ->formatStateUsing(fn($state) => strtoupper($state))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->prefix('Rp ')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Metode Bayar')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                DateRangeFilter::make('tanggal')
                    ->label('Filter Rentang Tanggal'),
                SelectFilter::make('jenis_kursus')
                    ->label('Filter Jenis Kursus')
                    ->options(function () {
                        return KursusKategori::query()
                            ->distinct()
                            ->pluck('jenis_kursus', 'jenis_kursus')
                            ->map(function ($item) {
                                return ucfirst($item);
                            })
                            ->toArray();
                    })
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['value'],
                            fn(Builder $query, $value): Builder => $query->whereHas('pendaftaran.jadwal.kategori', fn($q) => $q->where('jenis_kursus', $value))
                        );
                    })
            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(2)

            ->actions([
                // 
            ])
            ->bulkActions([
                ExportBulkAction::make()->label('Export XLS')
                    ->icon('heroicon-o-printer')
                    ->color('success'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKursusLaporanBulanans::route('/'),
        ];
    }
}
