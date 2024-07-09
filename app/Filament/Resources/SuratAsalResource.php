<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratAsalResource\Pages;
use App\Filament\Resources\SuratAsalResource\RelationManagers;
use App\Models\SuratAsal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratAsalResource extends Resource
{
    protected static ?string $model = SuratAsal::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Master Data Surat';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Input Data Asal Surat';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_asal_surat')->label('Asal Surat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('keterangan_asal_surat')->label('Keterangan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_asal_surat')->label('Asal Surat')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('keterangan_asal_surat')->label('Keterangan'),
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
            'index' => Pages\ListSuratAsals::route('/'),
            'create' => Pages\CreateSuratAsal::route('/create'),
            'edit' => Pages\EditSuratAsal::route('/{record}/edit'),
        ];
    }
}
