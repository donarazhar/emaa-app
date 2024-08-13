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

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Inventaris Satuan';
    protected static ?string $navigationLabel = 'Master Satuan';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Inventaris';
    protected static ?int $navigationSort = 8;

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
                Forms\Components\TextInput::make('nama_satuan')->label('Nama Satuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('keterangan_satuan')->label('Keterangan')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
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
            'index' => Pages\ListInventarisSatuans::route('/'),
            // 'create' => Pages\CreateInventarisSatuan::route('/create'),
            // 'edit' => Pages\EditInventarisSatuan::route('/{record}/edit'),
        ];
    }
}
