<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use App\Models\KasKecilTransaksi;
use Illuminate\Support\Collection;
use App\Models\KasKecilMatanggaran;
use Illuminate\Database\Query\Builder;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\Summarizers\Sum;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\KasKecilTransaksiResource\Pages;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class KasKecilTransaksiResource extends Resource
{
    protected static ?string $model = KasKecilTransaksi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-m-table-cells';
    protected static ?string $modelLabel = 'Kas Kecil';
    protected static ?int $navigationSort = 6;

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
                Forms\Components\TextInput::make('kategori')
                    ->default('pengeluaran')->readOnly(),
                Forms\Components\Select::make('kode_matanggaran')->label('Mata Anggaran')
                    ->label('Mata Anggaran')
                    ->options(function () {
                        return KasKecilMatanggaran::with('aas')
                            ->whereNotIn('kode_matanggaran', ['1.1.1', '1.1.2'])
                            ->get()
                            ->pluck('KodesMatanggaran', 'kode_matanggaran');
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('jumlah')->required()
                    ->label('Jumlah')->numeric()
                    ->prefix('Rp')
                    ->maxLength(10)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(','),
                Forms\Components\DatePicker::make('tgl_transaksi')->required()
                    ->label('Tanggal Transaksi'),
                Forms\Components\Textarea::make('perincian')->required()
                    ->label('Perincian'),
                Forms\Components\FileUpload::make('foto_kaskecil')
                    ->image()
                    ->multiple()
                    ->directory('file-kaskecil')
                    ->label('Lampiran'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.'),
                Tables\Columns\TextColumn::make('tgl_transaksi')->dateTime('d/m/Y')->label('Tgl'),
                Tables\Columns\TextColumn::make('matanggaran.kode_matanggaran')->label('Detail Akun')
                    ->description(fn(KasKecilTransaksi $record): string => $record->matanggaran->aas->kode_aas, position: 'above')
                    ->description(fn(KasKecilTransaksi $record): string => $record->matanggaran->aas->nama_aas)
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlah')->numeric()
                    ->label('Detail Perincian')
                    ->description(fn(KasKecilTransaksi $record): string => $record->matanggaran->aas->status, position: 'above')
                    ->description(fn(KasKecilTransaksi $record): string => $record->perincian)
                    ->color(
                        fn(KasKecilTransaksi $record): string =>
                        $record->kategori === 'pengisian' ? 'primary' : ($record->kategori === 'pembentukan' ? 'danger' : 'default')
                    )
                    ->searchable()
                    ->summarize(
                        Sum::make()
                            ->label('Total Pengeluaran')
                            ->query(fn(Builder $query) => $query->where('kategori', 'pengeluaran'))
                    ),
                Tables\Columns\ToggleColumn::make('pengisian_id')
                    ->label('Pencairan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->disabled(fn($record) => $record->kategori !== 'pengisian'),
            ])
            ->filters([
                DateRangeFilter::make('tgl_transaksi')
                    ->label('Filter by Tanggal'),
                SelectFilter::make('kategori')
                    ->options([
                        'pembentukan' => 'Pembentukan Kas',
                        'pengisian' => 'Pengisian Kas',
                        'pengeluaran' => 'Pengeluaran Kas',
                    ])
                    ->default('pembentukan')
                    ->label('Filter by Kategori'),
            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(2)

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver()
                        ->visible(fn($record) => $record->kategori !== 'pembentukan'),
                    Tables\Actions\EditAction::make()->color('primary')
                        ->slideOver()->visible(fn($record) => $record->kategori !== 'pembentukan'),
                    Tables\Actions\DeleteAction::make()->color('danger')
                        ->slideOver()->visible(fn($record) => $record->kategori !== 'pembentukan'),
                    Tables\Actions\Action::make('print')
                        ->label('Cetak')
                        ->icon('heroicon-m-printer')
                        ->color('success')
                        ->visible(fn($record) => $record->kategori === 'pengisian')
                        ->url(fn($record) => route('cetak-pengisiankas', $record->id))
                        ->openUrlInNewTab(),
                ]),

            ])
            ->headerActions([
                CreateAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Pengisian Kas Kecil')
                            ->body('Pengisian kas kecil berhasil dilakukan.'),
                    )
                    ->color('gray')->label('Pengisian Kas Kecil')->slideOver()
                    ->form([
                        Forms\Components\TextInput::make('kategori')
                            ->default('pengisian')->readOnly(),
                        Forms\Components\Select::make('kode_matanggaran')
                            ->label('Mata Anggaran')
                            ->options(function () {
                                return KasKecilMatanggaran::with('aas')
                                    ->where('kode_matanggaran', '1.1.2')
                                    ->get()
                                    ->pluck('KodesMatanggaran', 'kode_matanggaran');
                            })
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Group::make([
                            Forms\Components\DatePicker::make('start_date')
                                ->label('Mulai Tanggal')
                                ->dehydrated(false)  // Mencegah penyimpanan ke database
                                ->required(),
                            Forms\Components\DatePicker::make('tgl_transaksi')
                                ->label('Sampai Tanggal')
                                ->required()
                                ->reactive()  // Membuatnya bereaksi terhadap perubahan
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    $startDate = $get('start_date');
                                    $endDate = $state;
                                    // Query untuk menghitung total pengeluaran
                                    $totalPengeluaran = \App\Models\KasKecilTransaksi::where('kategori', 'pengeluaran')
                                        ->whereBetween('tgl_transaksi', [$startDate, $endDate])
                                        ->sum('jumlah');
                                    // Mengatur nilai 'jumlah'
                                    $set('jumlah', $totalPengeluaran);
                                }),

                        ])->columns(2),
                        Forms\Components\TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->prefix('Rp')
                            ->numeric()
                            ->readOnly()
                            ->required()
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(','),

                        Forms\Components\Textarea::make('perincian')
                            ->required()
                            ->label('Perincian'),
                    ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('print')
                        ->label('Export PDF')
                        ->color('success')
                        ->icon('heroicon-m-printer')
                        ->action(function (Collection $records) {
                            // Ambil ID dari record yang dipilih
                            $selectedIds = $records->pluck('id')->toArray();

                            // Ambil periode awal dan akhir berdasarkan tanggal terendah dan tertinggi
                            $periodeawal = $records->min('tgl_transaksi');
                            $periodeakhir = $records->max('tgl_transaksi');

                            // Redirect ke route dengan parameter ID yang dipilih dan periode
                            return redirect()->route('cetak-laporankas', [
                                'selected' => implode(',', $selectedIds),
                                'periodeawal' => $periodeawal,
                                'periodeakhir' => $periodeakhir,
                            ]);
                        })
                ])
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
            'index' => Pages\ListKasKecilTransaksis::route('/'),
            // 'create' => Pages\CreateKasKecilTransaksi::route('/create'),
            // 'edit' => Pages\EditKasKecilTransaksi::route('/{record}/edit'),
        ];
    }
}
