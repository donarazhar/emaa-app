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

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Guru';
    protected static ?string $navigationLabel = 'Guru';
    protected static ?string $navigationParentItem = 'Transaksi Kursus';
    protected static ?int $navigationSort = 3;

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
                Forms\Components\TextInput::make('nama')->label('Nama Guru')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')->label('Foto Profile')
                    ->image()->openable()->downloadable()->directory('file-kursus-guru'),
                Forms\Components\Select::make('jenkel')->label('Jenkel')->options([
                    'Laki-Laki' => '1. Laki-Laki',
                    'Perempuan' => '2. Perempuan',
                ])->required(),
                Forms\Components\DatePicker::make('sejak')->label('Bergabung Sejak')
                    ->date()
                    ->required(),
                Forms\Components\TextInput::make('email')->label('Email Address')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nomor_telepon')->label('No. HP')
                    ->numeric()
                    ->required()
                    ->maxLength(20),
                Forms\Components\Textarea::make('bidang_keahlian')->label('Bidang Keahlian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')
                    ->required()
                    ->maxLength(255),

            ])->columns(2);
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
                Tables\Columns\TextColumn::make('nama')->label('Detail Guru')->sortable()->searchable()
                    ->description(fn(KursusGuru $record): string => $record->jenkel, position: 'above')
                    ->description(fn(KursusGuru $record): string => $record->email),
                Tables\Columns\TextColumn::make('nomor_telepon')->label('Detail Kontak')
                    ->description(fn(KursusGuru $record): string => 'Sejak :' . ' ' . (new \DateTime($record->sejak))->format('d/m/Y'), position: 'above')
                    ->description(fn(KursusGuru $record): string => $record->alamat),
                Tables\Columns\TextColumn::make('bidang_keahlian')->label('Bidang Keahlian'),

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
