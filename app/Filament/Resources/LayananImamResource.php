<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananImamResource\Pages;
use App\Filament\Resources\LayananImamResource\RelationManagers;
use App\Models\LayananImam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LayananImamResource extends Resource
{
    protected static ?string $model = LayananImam::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Imams';
    protected static ?string $navigationLabel = 'Data Imam';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Transaksi Konsultasis';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_imam')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nohp_imam')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),
                Forms\Components\Textarea::make('keterangan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_imam')->label('Nama Imam'),
                Tables\Columns\TextColumn::make('nohp_imam')->label('No. Handphone'),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan'),
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
            'index' => Pages\ListLayananImams::route('/'),
            // 'create' => Pages\CreateLayananImam::route('/create'),
            // 'edit' => Pages\EditLayananImam::route('/{record}/edit'),
        ];
    }
}
