<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KursusJadwalResource\Pages;
use App\Filament\Resources\KursusJadwalResource\RelationManagers;
use App\Models\KursusJadwal;
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

class KursusJadwalResource extends Resource
{
    protected static ?string $model = KursusJadwal::class;

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $modelLabel = 'Jadwal Kursus';
    protected static ?string $navigationLabel = 'Jadwal Kursus';
    protected static ?string $navigationParentItem = 'Transaksi Kursus';
    protected static ?int $navigationSort = 5;

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
                Forms\Components\TextInput::make('hari')
                    ->label('Hari kursus')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TimePicker::make('jam_mulai')
                    ->label('Dari jam')
                    ->datalist([
                        '09:00',
                        '09:30',
                        '10:00',
                        '10:30',
                        '11:00',
                        '11:30',
                        '12:00',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('jam_selesai')
                    ->label('Sampai jam')
                    ->datalist([
                        '09:00',
                        '09:30',
                        '10:00',
                        '10:30',
                        '11:00',
                        '11:30',
                        '12:00',
                    ])
                    ->required(),
                Forms\Components\Select::make('kursus_kategori_id')
                    ->relationship('kursuskategori', 'nama_kursus')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $kategori = KursusKategori::find($state);
                        $set('nama_guru', $kategori ? $kategori->guru->nama : null);
                    }),
                Forms\Components\TextInput::make('nama_guru')
                    ->label('Nama Guru')
                    ->disabled()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('hari'),
                Tables\Columns\TextColumn::make('jam_mulai')->label('Mulai')
                    ->time(),
                Tables\Columns\TextColumn::make('jam_selesai')->label('Selesai')
                    ->time(),
                Tables\Columns\TextColumn::make('kursuskategori.nama_kursus')
                    ->label('Jenis Kursus'),
                Tables\Columns\TextColumn::make('kursuskategori.guru.nama')
                    ->label('Nama Guru'),

            ])
            ->filters([
                DateRangeFilter::make('tanggal'),
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
            'index' => Pages\ListKursusJadwals::route('/'),
            // 'create' => Pages\CreateKursusJadwal::route('/create'),
            // 'edit' => Pages\EditKursusJadwal::route('/{record}/edit'),
        ];
    }
}
