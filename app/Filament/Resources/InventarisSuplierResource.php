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
                Forms\Components\TextInput::make('nama_suplier')->label('Nama Suplier')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat_suplier')->label('Alamat Lengkap')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('kontak_suplier')->label('No. Kontak')
                    ->numeric()
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('email_suplier')->label('Email Address')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('keterangan_suplier')->label('Keterangan')
                    ->maxLength(255)
                    ->default(null),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_suplier')->label('Detail Suplier')
                    ->searchable()
                    ->description(fn(InventarisSuplier $record): string => $record->email_suplier, position: 'above')
                    ->description(fn(InventarisSuplier $record): string => $record->alamat_suplier),
                Tables\Columns\TextColumn::make('kontak_suplier')->label('No. HP')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver(),
                    Tables\Actions\EditAction::make()->color('primary')->slideOver(),
                    Tables\Actions\DeleteAction::make()->color('danger')->slideOver(),
                ]),
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
            // 'create' => Pages\CreateInventarisSuplier::route('/create'),
            // 'edit' => Pages\EditInventarisSuplier::route('/{record}/edit'),
        ];
    }
}
