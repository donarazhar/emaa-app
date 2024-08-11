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

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
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
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')->sortable(),
                Tables\Columns\TextColumn::make('kode_aas')->label('Kode AAS')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama_aas')->label('Nama AAS')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori'),
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
