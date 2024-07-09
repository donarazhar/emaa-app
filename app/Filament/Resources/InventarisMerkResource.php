<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisMerkResource\Pages;
use App\Filament\Resources\InventarisMerkResource\RelationManagers;
use App\Models\InventarisMerk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventarisMerkResource extends Resource
{
    protected static ?string $model = InventarisMerk::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Master Data Inventaris';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Input Data Merk';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_merk')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_merk')->label('Merk Barang')->searchable()->sortable(),
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
            'index' => Pages\ListInventarisMerks::route('/'),
            'create' => Pages\CreateInventarisMerk::route('/create'),
            'edit' => Pages\EditInventarisMerk::route('/{record}/edit'),
        ];
    }
}
