<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KursusGuruResource\Pages;
use App\Filament\Resources\KursusGuruResource\RelationManagers;
use App\Models\KursusGuru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KursusGuruResource extends Resource
{
    protected static ?string $model = KursusGuru::class;

    protected static ?string $navigationGroup = 'Kursus';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Guru';
    protected static ?string $navigationLabel = 'Guru';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nomor_telepon')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('bidang_keahlian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sejak')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('nomor_telepon'),
                Tables\Columns\TextColumn::make('bidang_keahlian'),
                Tables\Columns\TextColumn::make('sejak'),

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
            'index' => Pages\ListKursusGurus::route('/'),
            // 'create' => Pages\CreateKursusGuru::route('/create'),
            // 'edit' => Pages\EditKursusGuru::route('/{record}/edit'),
        ];
    }
}
