<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\KursusPendaftaran;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\KursusPendaftaranResource\Pages;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class KursusPendaftaranResource extends Resource
{
    protected static ?string $model = KursusPendaftaran::class;

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-m-academic-cap';
    protected static ?string $modelLabel = 'Transaksi Kursus';
    protected static ?string $navigationLabel = 'Transaksi Kursus';
    protected static ?int $navigationSort = 0;

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
                Forms\Components\DatePicker::make('tanggal')->label('Tgl. Input')
                    ->required(),
                Forms\Components\Select::make('kursus_murid_id')->label('Nama Murid')
                    ->relationship('murid', 'nama')
                    ->required(),
                Forms\Components\Select::make('kursus_jadwal_id')
                    ->options(function () {
                        return \App\Models\KursusJadwal::all()->pluck('combined_info', 'id');
                    })
                    ->label('Pilih Jadwal')
                    ->required(),

                Forms\Components\Select::make('status')->options([
                    'Aktif' => 'Aktif',
                    'Tidak Aktif' => 'Tidak Aktif',
                ])->label('Status')->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('No.')->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->label('Tgl. Input')->sortable()->searchable()
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('murid.nama')->sortable()->searchable()
                    ->label('Detail Murid')
                    ->description(fn(KursusPendaftaran $record): string => $record->jadwal->kategori->nama_kursus, position: 'above')
                    ->description(fn(KursusPendaftaran $record): string => $record->jadwal->hari),
                Tables\Columns\TextColumn::make('jadwal.kategori.jenis_kursus')
                    ->sortable()->searchable()->formatStateUsing(fn($state) => strtoupper($state))
                    ->label('Detail Jadwal')
                    ->description(fn(KursusPendaftaran $record): string => 'Ruang Kelas ' . $record->jadwal->ruang_kelas, position: 'above')
                    ->description(
                        fn(KursusPendaftaran $record): string =>
                        'Jam : ' . Carbon::parse($record->jadwal->jam_mulai)->format('H:i') .
                            ' - ' . Carbon::parse($record->jadwal->jam_selesai)->format('H:i') .
                            ' WIB'
                    ),
                Tables\Columns\TextColumn::make('jadwal.kategori.biaya')->numeric()->prefix('Rp ')->label('Biaya/bulan')
                    ->description(fn(KursusPendaftaran $record): string => $record->status),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pendaftaran')
                    ->description('Informasi lengkap data murid kursus')
                    ->icon('heroicon-s-circle-stack')
                    ->collapsible()
                    ->headerActions([
                        Action::make('Export File')
                            ->icon('heroicon-m-printer')
                            ->url(fn($record) => route('pdf.previewpendaftaran', ['id' => $record->id]))
                            ->openUrlInNewTab(true)
                            ->iconButton()
                            ->size(ActionSize::Large)
                            ->tooltip('Print PDF'),
                    ])
                    ->schema([
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema([
                                TextEntry::make('tanggal')
                                    ->label('Tanggal Input')
                                    ->dateTime('d/m/Y')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-calendar-days'),
                                TextEntry::make('murid.nama')
                                    ->label('Nama Murid')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-users'),
                                TextEntry::make('jadwal.jam_mulai')
                                    ->label('Jam Kursus')
                                    ->weight(FontWeight::Bold)
                                    ->formatStateUsing(fn($state, $record) => Carbon::parse($record->jadwal->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($record->jadwal->jam_selesai)->format('H:i'))
                                    ->icon('heroicon-o-clock'),
                                TextEntry::make('jadwal.kategori.jenis_kursus')
                                    ->label('Jenis Kursus')
                                    ->weight(FontWeight::Bold)
                                    ->formatStateUsing(fn($state) => strtoupper($state)),
                            ])->columns(4),
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema(
                                [
                                    TextEntry::make('jadwal.kategori.guru.nama')
                                        ->label('Nama Guru')
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-m-users'),
                                    TextEntry::make('jadwal.ruang_kelas')
                                        ->label('Ruang Kelas')
                                        ->weight(FontWeight::Bold),
                                    TextEntry::make('jadwal.kategori.nama_kursus')
                                        ->weight(FontWeight::Bold)
                                        ->label('Nama Kursus'),
                                    TextEntry::make('jadwal.kategori.biaya')
                                        ->label('Biaya/bulan')
                                        ->numeric()
                                        ->prefix('Rp ')
                                        ->weight(FontWeight::Bold),
                                ]
                            )->columns(4),
                    ]),

                // Section 2 Preview PDF
                Section::make('Preview Data')
                    ->description('Lihat data pendaftaran dengan PDF')
                    ->collapsed()
                    ->schema([
                        PdfViewerEntry::make('file')
                            ->label('')
                            ->minHeight('100svh')
                            ->fileUrl(function ($record) {
                                return route('pdf.previewpendaftaran', ['id' => $record->id]);
                            })
                            ->columnSpanFull()
                            ->schema([])
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
            'index' => Pages\ListKursusPendaftarans::route('/'),
            // 'create' => Pages\CreateKursusPendaftaran::route('/create'),
            // 'edit' => Pages\EditKursusPendaftaran::route('/{record}/edit'),
        ];
    }
}
