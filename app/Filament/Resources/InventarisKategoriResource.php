<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisKategoriResource\Pages;
use App\Filament\Resources\InventarisKategoriResource\RelationManagers;
use App\Models\InventarisKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventarisKategoriResource extends Resource
{
    protected static ?string $model = InventarisKategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Master Data Inventaris';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Input Data Kategori';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_kategori')->label('Nama Kategori')->searchable()->sortable(),
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
            'index' => Pages\ListInventarisKategoris::route('/'),
            'create' => Pages\CreateInventarisKategori::route('/create'),
            'edit' => Pages\EditInventarisKategori::route('/{record}/edit'),
        ];
    }
}
