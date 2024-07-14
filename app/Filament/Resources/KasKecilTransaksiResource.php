<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Filament\Resources\Resource;
use App\Models\KasKecilTransaksi;
use App\Models\KasKecilMatanggaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KasKecilTransaksiResource\Pages;
use App\Filament\Resources\KasKecilTransaksiResource\RelationManagers;

class KasKecilTransaksiResource extends Resource
{
    protected static ?string $model = KasKecilTransaksi::class;

    protected static ?string $navigationGroup = 'Kas Kecil';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Transaksi Kas Kecils';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('perincian')
                    ->label('Perincian'),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah'),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'pengeluaran' => 'Pengeluaran',
                    ])
                    ->required(),
                Forms\Components\Datepicker::make('tgl_transaksi')
                    ->label('Tanggal Transaksi'),
                Forms\Components\Select::make('matanggaran_id')->label('Mata Anggaran')
                    ->label('Mata Anggaran')
                    ->options(function () {
                        // Ambil semua akun anggaran beserta nama akun primary yang terkait
                        return KasKecilMatanggaran::with('aas')
                            ->get()
                            ->pluck('aas.nama_aas', 'id');
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('tgl_transaksi')->dateTime('d/m/Y')->label('Tgl')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.aas.kode_aas')->label('Akun AAS')->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.kode_matanggaran')->label('Mata Anggaran')->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.aas.nama_aas')->label('Nama Akun'),
                Tables\Columns\TextColumn::make('perincian')->label('Perincian')->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.aas.status')->label('D/K'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah (Rp)'),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListKasKecilTransaksis::route('/'),
            'create' => Pages\CreateKasKecilTransaksi::route('/create'),
            'edit' => Pages\EditKasKecilTransaksi::route('/{record}/edit'),
        ];
    }
}
