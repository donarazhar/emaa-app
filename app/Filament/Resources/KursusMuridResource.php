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

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Murids';
    protected static ?string $navigationLabel = 'Murid';
    protected static ?string $navigationParentItem = 'Transaksi Kursus';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')->label('Tgl. Daftar')
                    ->required(),
                Forms\Components\TextInput::make('nama')->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('jenkel')->label('Jenkel')->options([
                    'Laki-Laki' => '1. Laki-Laki',
                    'Perempuan' => '2. Perempuan',
                ])->required(),
                Forms\Components\TextInput::make('email')->label('Email Address')
                    ->required()
                    ->email()
                    ->maxLength(100),
                Forms\Components\TextInput::make('nomor_telepon')->label('No.HP')
                    ->numeric()
                    ->required()
                    ->maxLength(13),
                Forms\Components\FileUpload::make('foto')->label('Foto Profile')
                    ->image()->openable()->downloadable()->directory('file-kursus-murid'),
                Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')
                    ->required()
                    ->maxLength(255)->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.')->sortable(),
                Tables\Columns\ImageColumn::make('foto')->label('Photo')
                    ->circular()->size(80)->getStateUsing(function ($record) {
                        return $record->foto ? url('storage/' . $record->foto) : url('storage/file-user/no-image.jpg');
                    }),
                Tables\Columns\TextColumn::make('tanggal')->label('Tgl. Daftar')->dateTime('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('nama')->label('Detail Murid')->sortable()->searchable()
                    ->description(fn(KursusMurid $record): string => $record->jenkel, position: 'above')
                    ->description(fn(KursusMurid $record): string => $record->email),
                Tables\Columns\TextColumn::make('nomor_telepon')->label('Detail Kontak')
                    ->description(fn(KursusMurid $record): string => $record->alamat)
                    ->sortable()->searchable(),

            ])
            ->filters([
                DateRangeFilter::make('tanggal'),
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
            'index' => Pages\ListKursusMurids::route('/'),
            // 'create' => Pages\CreateKursusMurid::route('/create'),
            // 'edit' => Pages\EditKursusMurid::route('/{record}/edit'),
        ];
    }
}
