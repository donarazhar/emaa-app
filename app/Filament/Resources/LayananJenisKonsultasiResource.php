<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananJenisKonsultasiResource\Pages;
use App\Filament\Resources\LayananJenisKonsultasiResource\RelationManagers;
use App\Models\LayananJenisKonsultasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LayananJenisKonsultasiResource extends Resource
{
    protected static ?string $model = LayananJenisKonsultasi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Jenis Konsultasis';
    protected static ?string $navigationLabel = 'Master Jenis Konsultasi';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Layanan Konsultasis';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_jenis_konsultasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_jenis_konsultasi')->label('Jenis Konsultasi'),
                Tables\Columns\TextColumn::make('deskripsi')->label('deskripsi'),
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
            'index' => Pages\ListLayananJenisKonsultasis::route('/'),
            // 'create' => Pages\CreateLayananJenisKonsultasi::route('/create'),
            // 'edit' => Pages\EditLayananJenisKonsultasi::route('/{record}/edit'),
        ];
    }
}
