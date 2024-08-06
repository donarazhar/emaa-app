<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasKecilAasResource\Pages;
use App\Filament\Resources\KasKecilAasResource\RelationManagers;
use App\Models\KasKecilAas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KasKecilAasResource extends Resource
{
    protected static ?string $model = KasKecilAas::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Akun AAs';
    protected static ?string $navigationLabel = 'Master AAS';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Kas Kecils';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_aas')
                    ->label('Kode AAS'),

                Forms\Components\TextInput::make('nama_aas')
                    ->label('Nama AAS'),

                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'pembentukan' => 'Pembentukan',
                        'pengisian' => 'Pengisian',
                        'pengeluaran' => 'Pengeluaran',
                    ]),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'debit' => 'Debit',
                        'kredit' => 'Kredit',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('kode_aas')->label('Kode AAS'),
                Tables\Columns\TextColumn::make('nama_aas')->label('Nama AAS'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori'),
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
                    ExportBulkAction::make()
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
            'index' => Pages\ListKasKecilAas::route('/'),
            // 'create' => Pages\CreateKasKecilAas::route('/create'),
            // 'edit' => Pages\EditKasKecilAas::route('/{record}/edit'),
        ];
    }
}
