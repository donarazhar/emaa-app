<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratKategoriResource\Pages;
use App\Filament\Resources\SuratKategoriResource\RelationManagers;
use App\Models\SuratKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratKategoriResource extends Resource
{
    protected static ?string $model = SuratKategori::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Surats';
    protected static ?string $modelLabel = 'Kategori Surat';
    protected static ?string $navigationLabel = 'Data Kategori Surat';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Transaksi Surats';


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')->label('Kategori Surat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('keterangan_kategori')->label('Keterangan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_kategori')->label('Kategori Surat')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('keterangan_kategori')->label('Keterangan'),
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
            'index' => Pages\ListSuratKategoris::route('/'),
            'create' => Pages\CreateSuratKategori::route('/create'),
            'edit' => Pages\EditSuratKategori::route('/{record}/edit'),
        ];
    }
}
