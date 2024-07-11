<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisBagianResource\Pages;
use App\Filament\Resources\InventarisBagianResource\RelationManagers;
use App\Models\InventarisBagian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventarisBagianResource extends Resource
{
    protected static ?string $model = InventarisBagian::class;

    protected static ?string $navigationGroup = 'Inventaris';
    protected static ?string $modelLabel = 'Inventaris Bagian';
    protected static ?string $navigationLabel = 'Data Bagian Inv';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Transaksi Data Inventaris';
    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_bagian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('keterangan_bagian')
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('nama_bagian')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('keterangan_bagian'),
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
            'index' => Pages\ListInventarisBagians::route('/'),
            // 'create' => Pages\CreateInventarisBagian::route('/create'),
            // 'edit' => Pages\EditInventarisBagian::route('/{record}/edit'),
        ];
    }
}
