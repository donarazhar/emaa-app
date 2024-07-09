<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratTransaksiResource\Pages;
use App\Filament\Resources\SuratTransaksiResource\RelationManagers;
use App\Models\SuratTransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratTransaksiResource extends Resource
{
    protected static ?string $model = SuratTransaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Transaksi Surat';

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
                //
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
            'index' => Pages\ListSuratTransaksis::route('/'),
            'create' => Pages\CreateSuratTransaksi::route('/create'),
            'edit' => Pages\EditSuratTransaksi::route('/{record}/edit'),
        ];
    }
}
