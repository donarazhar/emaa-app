<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KursusPendaftaranResource\Pages;
use App\Filament\Resources\KursusPendaftaranResource\RelationManagers;
use App\Models\KursusPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KursusPendaftaranResource extends Resource
{
    protected static ?string $model = KursusPendaftaran::class;

    protected static ?string $navigationGroup = 'Kursus';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $modelLabel = 'Transaksi Kursus';
    protected static ?string $navigationLabel = 'Transaksi Kursus';
    protected static ?int $navigationSort = 0;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')->label('Tgl')
                    ->required(),
                Forms\Components\Select::make('kursus_murid_id')
                    ->relationship('murid', 'nama')
                    ->required(),
                Forms\Components\Select::make('kursus_jadwal_id')
                    ->options(function () {
                        return \App\Models\KursusJadwal::all()->pluck('combined_info', 'id');
                    })
                    ->label('Pilih Jadwal')
                    ->required(),

                Forms\Components\Select::make('status')->options([
                    'Aktif' => 'Aktif',
                    'Tidak Aktif' => 'Tidak Aktif',
                ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Id'),
                Tables\Columns\TextColumn::make('tanggal')->sortable()->searchable()
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('murid.nama')->sortable()->searchable()
                    ->label('Murid'),
                Tables\Columns\TextColumn::make('jadwal.combined_info')->sortable()->searchable()
                    ->label('Jadwal'),

                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                DateRangeFilter::make('tanggal'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->color('info'),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListKursusPendaftarans::route('/'),
            // 'create' => Pages\CreateKursusPendaftaran::route('/create'),
            // 'edit' => Pages\EditKursusPendaftaran::route('/{record}/edit'),
        ];
    }
}
