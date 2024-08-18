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

    protected static ?int $navigationSort = 20;
    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Kategori Surat';
    protected static ?string $navigationLabel = 'Master Kategori Surat';
    protected static ?string $navigationParentItem = 'Persuratans';
    protected static ?string $navigationIcon = 'heroicon-m-tag';


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
                Forms\Components\TextInput::make('nama_kategori')->label('Kategori Surat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('keterangan_kategori')->label('Keterangan')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')->rowIndex(),
                Tables\Columns\TextColumn::make('nama_kategori')->label('Kategori Surat')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('keterangan_kategori')->label('Keterangan'),
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
            'index' => Pages\ListSuratKategoris::route('/'),
            // 'create' => Pages\CreateSuratKategori::route('/create'),
            // 'edit' => Pages\EditSuratKategori::route('/{record}/edit'),
        ];
    }
}
