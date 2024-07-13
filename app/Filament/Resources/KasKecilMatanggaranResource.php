<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasKecilMatanggaranResource\Pages;
use App\Filament\Resources\KasKecilMatanggaranResource\RelationManagers;
use App\Models\KasKecilMatanggaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KasKecilMatanggaranResource extends Resource
{
    protected static ?string $model = KasKecilMatanggaran::class;

    protected static ?string $navigationGroup = 'Kas Kecil';
    protected static ?string $modelLabel = 'Akun Matanggarans';
    protected static ?string $navigationLabel = 'Akun Matanggarans';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Transaksi Kas Kecils';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_matanggaran')->label('Kode Matanggaran'),
                Forms\Components\Select::make('kas_kecil_aas_id')->label('Akun AAS')
                    ->relationship('aas', 'nama_aas')
                    ->required(),
                Forms\Components\TextInput::make('saldo')->label('Saldo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('kode_matanggaran')->label('Kode matanggaran'),
                Tables\Columns\TextColumn::make('aas.nama_aas')->label('Nama AAS'),
                Tables\Columns\TextColumn::make('saldo')->label('Saldo'),
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
            'index' => Pages\ListKasKecilMatanggarans::route('/'),
            'create' => Pages\CreateKasKecilMatanggaran::route('/create'),
            'edit' => Pages\EditKasKecilMatanggaran::route('/{record}/edit'),
        ];
    }
}
