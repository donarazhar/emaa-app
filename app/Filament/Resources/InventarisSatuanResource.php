<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisSatuanResource\Pages;
use App\Filament\Resources\InventarisSatuanResource\RelationManagers;
use App\Models\InventarisSatuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventarisSatuanResource extends Resource
{
    protected static ?string $model = InventarisSatuan::class;

    protected static ?string $navigationGroup = 'Inventaris';
    protected static ?string $modelLabel = 'Inventaris Satuan';
    protected static ?string $navigationLabel = 'Data Satuan Inv';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Transaksi Data Inventaris';
    protected static ?int $navigationSort = 8;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_satuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('keterangan_satuan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_satuan')->label('Nama Satuan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('keterangan_satuan')->label('Keterangan'),
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
            'index' => Pages\ListInventarisSatuans::route('/'),
            // 'create' => Pages\CreateInventarisSatuan::route('/create'),
            // 'edit' => Pages\EditInventarisSatuan::route('/{record}/edit'),
        ];
    }
}
