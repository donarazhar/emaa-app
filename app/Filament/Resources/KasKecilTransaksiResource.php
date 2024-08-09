<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KasKecilAas;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use App\Models\KasKecilTransaksi;
use App\Models\KasKecilMatanggaran;
use Filament\Actions\ReplicateAction;
use Illuminate\Database\Query\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\KasKecilTransaksiResource\Pages;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use App\Filament\Resources\KasKecilTransaksiResource\RelationManagers;

class KasKecilTransaksiResource extends Resource
{
    protected static ?string $model = KasKecilTransaksi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $modelLabel = 'Kas Kecil';
    protected static ?int $navigationSort = 6;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
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
                Tables\Columns\TextColumn::make('id')->rowIndex()->label('No.'),
                Tables\Columns\TextColumn::make('tgl_transaksi')->dateTime('d/m/Y')->label('Tgl')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.kode_matanggaran')->label('Detail Akun')
                    ->description(fn(KasKecilTransaksi $record): string => $record->matanggaran->aas->kode_aas, position: 'above')
                    ->description(fn(KasKecilTransaksi $record): string => $record->matanggaran->aas->nama_aas)
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('perincian')
                    ->label('Detail Perincian')
                    // ->summarize([
                    //     // Pengeluaran untuk bulan berjalan
                    //     Summarizer::make()
                    //         ->label(fn() => '#Pengeluaran ' . Carbon::now()->locale('id')->translatedFormat('F'))
                    //         ->numeric()
                    //         ->using(function (Builder $query): string {
                    //             $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
                    //             $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
                    //             return (string) $query
                    //                 ->whereBetween('tgl_transaksi', [$startOfMonth, $endOfMonth])
                    //                 ->where('kategori', 'pengeluaran')
                    //                 ->sum('jumlah');
                    //         }),

                    //     // Total pengeluaran sesuai filter (tidak spesifik per bulan)
                    //     Summarizer::make()
                    //         ->label('#Pengeluaran by Filter')
                    //         ->numeric()
                    //         ->using(function (Builder $query): string {
                    //             return (string) $query
                    //                 ->where('kategori', 'pengeluaran')
                    //                 ->sum('jumlah');  // Total sesuai dengan filter yang diterapkan
                    //         }),

                    //     // Total pengisian sesuai filter (tidak spesifik per bulan)
                    //     Summarizer::make()
                    //         ->label(fn() => '#Pengisian by Filter')
                    //         ->numeric()
                    //         ->using(function (Builder $query): string {
                    //             return (string) $query
                    //                 ->where('kategori', 'pengisian')
                    //                 ->sum('jumlah');
                    //         }),
                    // ])
                    ->description(fn(KasKecilTransaksi $record): string => $record->matanggaran->aas->status, position: 'above')
                    ->description(fn(KasKecilTransaksi $record): string => number_format($record->jumlah, 0, ',', ','))
                    ->color(
                        fn(KasKecilTransaksi $record): string =>
                        $record->kategori === 'pengisian' ? 'primary' : ($record->kategori === 'pembentukan' ? 'danger' : 'default')
                    )
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('pengisian_id')
                    ->label('Pencairan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->disabled(fn($record) => $record->kategori !== 'pengisian'),

            ])
            ->filters([
                DateRangeFilter::make('tgl_transaksi'),
                SelectFilter::make('kategori')
                    ->options([
                        'pengisian' => 'Pengisian Kas',
                        'pengeluaran' => 'Pengeluaran Kas',
                    ])->label('Filter by Kategori'),
            ], layout: FiltersLayout::AboveContentCollapsible)->filtersFormColumns(2)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver()
                        ->visible(fn($record) => $record->kategori !== 'pembentukan'),
                    Tables\Actions\EditAction::make()->color('primary')
                        ->slideOver()->visible(fn($record) => $record->kategori !== 'pembentukan'),
                    Tables\Actions\DeleteAction::make()->color('danger')
                        ->slideOver()->visible(fn($record) => $record->kategori !== 'pembentukan'),
                ])
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
                        Forms\Components\Select::make('kode_matanggaran')->label('Mata Anggaran')
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
                        Forms\Components\TextInput::make('jumlah')->required()
                            ->label('Jumlah')->numeric()
                            ->maxLength(10)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(','),
                        Forms\Components\DatePicker::make('tgl_transaksi')->required()
                            ->label('Tanggal Transaksi'),
                        Forms\Components\Textarea::make('perincian')->required()
                            ->label('Perincian'),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->color('info'),
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListKasKecilTransaksis::route('/'),
            // 'create' => Pages\CreateKasKecilTransaksi::route('/create'),
            // 'edit' => Pages\EditKasKecilTransaksi::route('/{record}/edit'),
        ];
    }
}
