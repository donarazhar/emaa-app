<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisSuplierResource\Pages;
use App\Filament\Resources\InventarisSuplierResource\RelationManagers;
use App\Models\InventarisSuplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventarisSuplierResource extends Resource
{
    protected static ?string $model = InventarisSuplier::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Inventaris Suplier';
    protected static ?string $navigationLabel = 'Master Suplier';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Inventaris';
    protected static ?int $navigationSort = 9;

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
                Forms\Components\TextInput::make('nama_suplier')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat_suplier')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('kontak_suplier')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('email_suplier')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('keterangan_suplier')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_suplier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat_suplier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kontak_suplier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_suplier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListInventarisSupliers::route('/'),
            'create' => Pages\CreateInventarisSuplier::route('/create'),
            'edit' => Pages\EditInventarisSuplier::route('/{record}/edit'),
        ];
    }
}
