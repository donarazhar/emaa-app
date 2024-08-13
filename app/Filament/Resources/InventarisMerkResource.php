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

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Inventaris Merk';
    protected static ?string $navigationLabel = 'Master Merk';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Inventaris';
    protected static ?int $navigationSort = 7;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_merk')->label('Merk Barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('keterangan_merk')->label('Keterangan Merk')
                    ->required()
                    ->maxLength(255)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_merk')->label('Merk Barang')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('keterangan_merk')->label('Keterangan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver(),
                    Tables\Actions\EditAction::make()->color('primary')->slideOver(),
                    Tables\Actions\DeleteAction::make()->color('danger')->slideOver(),
                ])
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
            // 'create' => Pages\CreateInventarisMerk::route('/create'),
            // 'edit' => Pages\EditInventarisMerk::route('/{record}/edit'),
        ];
    }
}
