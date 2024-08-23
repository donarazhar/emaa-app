<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use App\Models\KursusKategori;
use Filament\Resources\Resource;
use App\Filament\Resources\KursusKategoriResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KursusKategoriResource extends Resource
{
    protected static ?string $model = KursusKategori::class;

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Jenis Kursus';
    protected static ?string $navigationLabel = 'Jenis Kursus';
    protected static ?string $navigationParentItem = 'Transaksi Kursus';
    protected static ?int $navigationSort = 4;

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
                Forms\Components\TextInput::make('nama_kursus')->label('Nama Kursus')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('durasi')->label('Durasi Ajar *menit')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('biaya')->label('Biaya perbulan')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\Select::make('jenis_kursus')->label('Jenis Kursus')->options([
                    'reguler' => '1. Reguler',
                    'private' => '2. Private',
                ])->required(),
                Forms\Components\Select::make('kursus_guru_id')->label('Nama Guru')
                    ->relationship('guru', 'nama')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')->label('Keterangan')
                    ->required(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.')->sortable(),
                Tables\Columns\TextColumn::make('nama_kursus')->label('Detail Kursus')->sortable()->searchable()
                    ->description(fn(KursusKategori $record): string => $record->guru->nama, position: 'above')
                    ->description(fn(KursusKategori $record): string => $record->deskripsi),
                Tables\Columns\TextColumn::make('biaya')->label('Detail Biaya')->numeric()->prefix('Rp ')
                    ->description(fn(KursusKategori $record): string => 'Durasi : ' . $record->durasi . 'menit', position: 'above')
                    ->description(fn(KursusKategori $record): string => 'Jenis: ' . strtoupper($record->jenis_kursus)),
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
            'index' => Pages\ListKursusKategoris::route('/'),
            // 'create' => Pages\CreateKursusKategori::route('/create'),
            // 'edit' => Pages\EditKursusKategori::route('/{record}/edit'),
        ];
    }
}
