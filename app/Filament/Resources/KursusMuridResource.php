<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KursusMuridResource\Pages;
use App\Filament\Resources\KursusMuridResource\RelationManagers;
use App\Models\KursusMurid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KursusMuridResource extends Resource
{
    protected static ?string $model = KursusMurid::class;

    protected static ?string $navigationGroup = 'Kursus';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Murids';
    protected static ?string $navigationLabel = 'Murid';

    // // Menampilkan search
    // protected static ?string $recordTitleAttribute = 'nama';

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
                    ->maxLength(100),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(100),
                Forms\Components\TextInput::make('nomor_telepon')
                    ->required()
                    ->maxLength(20),
                Forms\Components\DatePicker::make('tanggal_daftar')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alamat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nomor_telepon')->label('No.HP')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggal_daftar')->label('Daftar')->dateTime('d/m/Y')->sortable(),

            ])
            ->filters([
                DateRangeFilter::make('tanggal_daftar'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
                ])
            ])
            ->bulkActions([
                ExportBulkAction::make()->color('info'),
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListKursusMurids::route('/'),
            // 'create' => Pages\CreateKursusMurid::route('/create'),
            // 'edit' => Pages\EditKursusMurid::route('/{record}/edit'),
        ];
    }
}
