<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KursusPembayaran;
use Filament\Resources\Resource;
use App\Models\KursusPendaftaran;
use Illuminate\Database\Query\Builder;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Summarizers\Sum;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\KursusPembayaranResource\Pages;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class KursusPembayaranResource extends Resource
{
    protected static ?string $model = KursusPembayaran::class;

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-m-credit-card';
    protected static ?string $modelLabel = 'Transaksi Bayar';
    protected static ?string $navigationLabel = 'Transaksi Bayar';
    protected static ?int $navigationSort = 1;

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
                Forms\Components\Select::make('kursus_pendaftaran_id')
                    ->options(function () {
                        return KursusPendaftaran::all()->pluck('combined_info', 'id');
                    })
                    ->searchable()
                    ->label('Transaksi Kursus')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $pendaftaran = KursusPendaftaran::with('jadwal.kategori')->find($state);
                        $set('jumlah', $pendaftaran ? $pendaftaran->jadwal->kategori->biaya : null);
                    })->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tgl. Transaksi')
                    ->required(),
                Forms\Components\Select::make('metode_pembayaran')->label('Metode Pembayaran')
                    ->options([
                        'Tunai' => '1. Tunai',
                        'Transfer Bank' => '2. Tranfer Bank',
                        'Kartu Kredit' => '3. Kartu Kredit'
                    ])
                    ->required(),
                Forms\Components\Select::make('status')->label('Status')
                    ->options([
                        'Tertunda ' => '1. Tertunda ',
                        'Lunas' => '2. Lunas',
                        'Dibatalkan' => '3. Dibatalkan',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('foto')->label('Lampiran')
                    ->image()->openable()->downloadable()->directory('file-bayarkursus'),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->prefix('Rp')
                    ->readOnly()
                    ->numeric()
                    ->required()
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.')->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->dateTime('d/m/Y')->label('Tgl. Transaksi'),
                Tables\Columns\TextColumn::make('pendaftaran.murid.nama')->searchable()->label('Detail Murid')
                    ->description(fn(KursusPembayaran $record): string => $record->pendaftaran->jadwal->kategori->nama_kursus, position: 'above')
                    ->description(fn(KursusPembayaran $record): string => $record->pendaftaran->jadwal->hari),
                Tables\Columns\TextColumn::make('pendaftaran.jadwal.kategori.guru.nama')->searchable()->label('Detail Guru')
                    ->description(
                        fn(KursusPembayaran $record): string =>
                        'Ruang Kelas ' . $record->pendaftaran->jadwal->ruang_kelas . ' (' . strtoupper($record->pendaftaran->jadwal->kategori->jenis_kursus) . ')',
                        position: 'above'
                    )
                    ->description(
                        fn(KursusPembayaran $record): string =>
                        'Jam : ' . Carbon::parse($record->pendaftaran->jadwal->jam_mulai)->format('H:i') .
                            ' - ' . Carbon::parse($record->pendaftaran->jadwal->jam_selesai)->format('H:i') .
                            ' WIB'
                    ),
                Tables\Columns\TextColumn::make('jumlah')->label('Detail Pembayaran')
                    ->numeric()->prefix('Rp ')
                    ->description(fn(KursusPembayaran $record): string => 'Via : ' . $record->metode_pembayaran, position: 'above')
                    ->description(fn(KursusPembayaran $record): string => 'Status : ' . $record->status)
                // ->summarize(
                //     Sum::make()
                //         ->label('Total per Bulan')
                //         ->query(
                //             fn(Builder $query) => $query
                //                 ->whereMonth('tanggal', Carbon::now()->month)
                //                 ->whereYear('tanggal', Carbon::now()->year)
                //         )
                // )
                // ->summarize(
                //     Sum::make()
                //         ->label('Total Reguler')
                //         ->query(
                //             fn(Builder $query) => $query
                //                 ->whereRaw("EXISTS (
                //                             SELECT 1
                //                             FROM kursus_pendaftarans
                //                             JOIN kursus_jadwals ON kursus_pendaftarans.kursus_jadwal_id = kursus_jadwals.id
                //                             JOIN kursus_kategoris ON kursus_jadwals.kursus_kategori_id = kursus_kategoris.id
                //                             WHERE kursus_pembayarans.kursus_pendaftaran_id = kursus_pendaftarans.id
                //                             AND kursus_kategoris.jenis_kursus = 'reguler'
                //                         )")
                //                 ->whereMonth('tanggal', Carbon::now()->month)
                //                 ->whereYear('tanggal', Carbon::now()->year)
                //         )
                // )
                // ->summarize(
                //     Sum::make()
                //         ->label('Total Private')
                //         ->query(
                //             fn(Builder $query) => $query
                //                 ->whereRaw("EXISTS (
                //                             SELECT 1
                //                             FROM kursus_pendaftarans
                //                             JOIN kursus_jadwals ON kursus_pendaftarans.kursus_jadwal_id = kursus_jadwals.id
                //                             JOIN kursus_kategoris ON kursus_jadwals.kursus_kategori_id = kursus_kategoris.id
                //                             WHERE kursus_pembayarans.kursus_pendaftaran_id = kursus_pendaftarans.id
                //                             AND kursus_kategoris.jenis_kursus = 'private'
                //                         )")
                //                 ->whereMonth('tanggal', Carbon::now()->month)
                //                 ->whereYear('tanggal', Carbon::now()->year)
                //         )
                // )
                ,
                Tables\Columns\ImageColumn::make('foto')->label('Lampiran')
                    ->circular()->size(80)->getStateUsing(function ($record) {
                        return $record->foto ? url('storage/' . $record->foto) : url('storage/file-user/no-image.jpg');
                    }),

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
                Section::make('Informasi Pembayaran')
                    ->description('Informasi lengkap pembayaran kursus')
                    ->icon('heroicon-s-circle-stack')
                    ->collapsible()
                    ->headerActions([
                        Action::make('Export File')
                            ->icon('heroicon-m-printer')
                            ->url(fn($record) => route('pdf.previewkwitansi', ['id' => $record->id]))
                            ->openUrlInNewTab(true)
                            ->iconButton()
                            ->size(ActionSize::Large)
                            ->tooltip('Print Kwitansi'),
                    ])
                    ->schema([
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema([
                                TextEntry::make('tanggal')
                                    ->label('Tanggal Input')
                                    ->dateTime('d/m/Y')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-calendar-days'),
                                TextEntry::make('pendaftaran.murid.nama')
                                    ->label('Nama Murid')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-users'),
                                TextEntry::make('pendaftaran.jadwal.jam_mulai')
                                    ->label('Jam Kursus')
                                    ->weight(FontWeight::Bold)
                                    ->formatStateUsing(fn($state, $record) => Carbon::parse($record->pendaftaran->jadwal->jam_mulai)->format('H:i') . ' - ' . Carbon::parse($record->pendaftaran->jadwal->jam_selesai)->format('H:i'))
                                    ->icon('heroicon-o-clock'),
                                TextEntry::make('pendaftaran.jadwal.kategori.jenis_kursus')
                                    ->label('Jenis Kursus')
                                    ->weight(FontWeight::Bold)
                                    ->formatStateUsing(fn($state) => strtoupper($state)),
                            ])->columns(4),
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema(
                                [
                                    TextEntry::make('pendaftaran.jadwal.kategori.guru.nama')
                                        ->label('Nama Guru')
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-m-users'),
                                    TextEntry::make('pendaftaran.jadwal.ruang_kelas')
                                        ->label('Ruang Kelas')
                                        ->weight(FontWeight::Bold),
                                    TextEntry::make('pendaftaran.jadwal.kategori.nama_kursus')
                                        ->weight(FontWeight::Bold)
                                        ->label('Nama Kursus'),
                                    TextEntry::make('pendaftaran.jadwal.kategori.biaya')
                                        ->label('Biaya/bulan')
                                        ->numeric()
                                        ->prefix('Rp ')
                                        ->weight(FontWeight::Bold),
                                ]
                            )->columns(4),
                    ]),

                // Section 2 Preview PDF
                Section::make('Preview Data')
                    ->description('Lihat kwitansi pembayaran')
                    ->collapsed()
                    ->schema([
                        PdfViewerEntry::make('file')
                            ->label('')
                            ->minHeight('100svh')
                            ->fileUrl(function ($record) {
                                return route('pdf.previewkwitansi', ['id' => $record->id]);
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
            'index' => Pages\ListKursusPembayarans::route('/'),
            // 'create' => Pages\CreateKursusPembayaran::route('/create'),
            // 'edit' => Pages\EditKursusPembayaran::route('/{record}/edit'),
        ];
    }
}
