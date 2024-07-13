<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasKecilTransaksiResource\Pages;
use App\Filament\Resources\KasKecilTransaksiResource\RelationManagers;
use App\Models\KasKecilTransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KasKecilTransaksiResource extends Resource
{
    protected static ?string $model = KasKecilTransaksi::class;

    protected static ?string $navigationGroup = 'Kas Kecil';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Transaksi Kas Kecils';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('perincian')
                    ->label('Perincian'),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah'),

                Forms\Components\TextInput::make('kategori')
                    ->label('Kategori'),
                Forms\Components\Datepicker::make('tgl_transaksi')
                    ->label('Tanggal Transaksi')
                    ->format('YYYY-MM-DD'),
                Forms\Components\Select::make('matanggaran_id')->label('Mata Anggaran')
                    ->relationship('matanggaran', 'kode_matanggaran')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('perincian')->label('Perincian'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah'),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('tgl_transaksi')->label('Tanggal Transaksi'),
                Tables\Columns\TextColumn::make('pengisian_id')->label('Pengisian ID'),
                Tables\Columns\TextColumn::make('matanggaran.kode_matanggaran')->label('Mata Anggaran'),
            ])
            ->filters([
                //
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
