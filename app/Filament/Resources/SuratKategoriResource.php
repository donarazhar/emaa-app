<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratKategoriResource\Pages;
use App\Filament\Resources\SuratKategoriResource\RelationManagers;
use App\Models\SuratKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratKategoriResource extends Resource
{
    protected static ?string $model = SuratKategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data Surat';
    protected static ?string $navigationLabel = 'Input Data Kategori Surat';

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
            'index' => Pages\ListSuratKategoris::route('/'),
            'create' => Pages\CreateSuratKategori::route('/create'),
            'edit' => Pages\EditSuratKategori::route('/{record}/edit'),
        ];
    }
}
