<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KursusKategoriResource\Pages;
use App\Filament\Resources\KursusKategoriResource\RelationManagers;
use App\Models\KursusKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KursusKategoriResource extends Resource
{
    protected static ?string $model = KursusKategori::class;

    protected static ?string $navigationGroup = 'Kursus';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $modelLabel = 'Jenis Kursus';
    protected static ?string $navigationLabel = 'Jenis Kursus';
    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kursus')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('durasi')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('biaya')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('kursus_guru_id')
                    ->relationship('guru', 'nama')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('nama_kursus'),
                Tables\Columns\TextColumn::make('deskripsi'),
                Tables\Columns\TextColumn::make('durasi'),
                Tables\Columns\TextColumn::make('biaya'),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Nama Guru'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->color('info'),
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
            'index' => Pages\ListKursusKategoris::route('/'),
            // 'create' => Pages\CreateKursusKategori::route('/create'),
            // 'edit' => Pages\EditKursusKategori::route('/{record}/edit'),
        ];
    }
}
