<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SertifikatResource\Pages;
use App\Filament\Resources\SertifikatResource\RelationManagers;
use App\Models\Sertifikat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SertifikatResource extends Resource
{
    protected static ?string $model = Sertifikat::class;

    protected static ?string $navigationGroup = 'Marbot';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Data Sertifikat';
    protected static ?string $navigationLabel = 'Data Sertifikat';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama'),
                Forms\Components\TextInput::make('deskripsi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('deskripsi'),
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
            'index' => Pages\ListSertifikats::route('/'),
            'create' => Pages\CreateSertifikat::route('/create'),
            'edit' => Pages\EditSertifikat::route('/{record}/edit'),
        ];
    }
}
