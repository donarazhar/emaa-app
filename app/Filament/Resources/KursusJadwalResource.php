<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KursusJadwal;
use App\Models\KursusKategori;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KursusJadwalResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\KursusJadwalResource\RelationManagers;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

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
                    ->label('Hari Kursus')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TimePicker::make('jam_mulai')
                    ->label('Dari jam')
                    ->native(false)
                    ->hoursStep(1)
                    ->minutesStep(15)
                    ->secondsStep(10)
                    ->required(),
                Forms\Components\TimePicker::make('jam_selesai')
                    ->label('Sampai jam')
                    ->native(false)
                    ->hoursStep(1)
                    ->minutesStep(15)
                    ->secondsStep(10)
                    ->required(),
                Forms\Components\Select::make('ruang_kelas')->label('Ruang Kelas')->options([
                    '101' => '1. Ruang 101',
                    '102' => '2. Ruang 102',
                    '103' => '3. Ruang 103',
                    '104' => '4. Ruang 104',
                    '105' => '5. Ruang 105',
                    '106' => '6. Ruang 106',
                ])->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('kursus_kategori_id')
                    ->label('Jenis Kursus')
                    ->options(function () {
                        return KursusKategori::with('guru')->get()->mapWithKeys(function ($kategori) {
                            return [
                                $kategori->id => $kategori->nama_kursus . ' (' . ucfirst($kategori->jenis_kursus) . ') - ' . $kategori->guru->nama
                            ];
                        });
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $kategori = KursusKategori::find($state);
                        $set('nama_guru', $kategori ? $kategori->guru->nama : null);
                    })
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.')->sortable(),
                Tables\Columns\TextColumn::make('hari')->label('Detail Waktu')
                    ->description(
                        fn(KursusJadwal $record): string =>
                        'Jam : ' . Carbon::parse($record->jam_mulai)->format('H:i') .
                            ' - ' . Carbon::parse($record->jam_selesai)->format('H:i') .
                            ' WIB'
                    ),
                Tables\Columns\TextColumn::make('kategori.nama_kursus')->label('Detail Kursus')
                    ->description(fn(KursusJadwal $record): string => 'Guru : ' . $record->kategori->guru->nama, position: 'above')
                    ->description(
                        fn(KursusJadwal $record): string =>
                        'Ruang Kelas: ' . $record->ruang_kelas . ' (' . strtoupper($record->kategori->jenis_kursus) . ')'
                    ),
                Tables\Columns\TextColumn::make('kategori.biaya')->label('Biaya/bulan')
                    ->numeric()
                    ->prefix('Rp ')

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
            'index' => Pages\ListKursusJadwals::route('/'),
            // 'create' => Pages\CreateKursusJadwal::route('/create'),
            // 'edit' => Pages\EditKursusJadwal::route('/{record}/edit'),
        ];
    }
}
