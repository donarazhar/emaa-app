<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KasKecilAas;
use Filament\Resources\Resource;
use App\Models\KasKecilMatanggaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KasKecilMatanggaranResource\Pages;
use App\Filament\Resources\KasKecilMatanggaranResource\RelationManagers;

class KasKecilMatanggaranResource extends Resource
{
    protected static ?string $model = KasKecilMatanggaran::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Akun Matanggarans';
    protected static ?string $navigationLabel = 'Master Matanggaran';
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
                Forms\Components\TextInput::make('kode_matanggaran')->label('Kode Matanggaran'),
                Forms\Components\Select::make('kode_aas')->label('Akun AAS')
                    ->options(function () {
                        return KasKecilAas::all()->pluck('KodesAas', 'kode_aas');
                    })
                    ->required(),
                Forms\Components\TextInput::make('saldo')->label('Saldo')->prefix('Rp'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.')->sortable(),
                Tables\Columns\TextColumn::make('kode_matanggaran')->label('Kode Matanggaran')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('aas.kode_aas')->label('Kode AAS')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('aas.nama_aas')->label('Nama AAS')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('saldo')->label('Saldo')->numeric(),
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
            'index' => Pages\ListKasKecilMatanggarans::route('/'),
            // 'create' => Pages\CreateKasKecilMatanggaran::route('/create'),
            // 'edit' => Pages\EditKasKecilMatanggaran::route('/{record}/edit'),
        ];
    }
}
