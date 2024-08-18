<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use App\Models\InventarisTransaksi;
use App\Models\InventarisPenyusutan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InventarisPenyusutanResource\Pages;
use App\Filament\Resources\InventarisPenyusutanResource\RelationManagers;

class InventarisPenyusutanResource extends Resource
{
    protected static ?string $model = InventarisPenyusutan::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $modelLabel = 'Inventaris Penyusutan';
    protected static ?string $navigationLabel = 'Hitung Penyusutan';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Inventaris';
    protected static ?int $navigationSort = 10;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('inventaris_transaksi_id')
                    ->label('Inventaris Transaksi')
                    ->options(function () {
                        // Dapatkan semua inventaris_transaksi_id yang sudah ada di tabel penyusutan
                        $usedTransaksiIds = InventarisPenyusutan::pluck('inventaris_transaksi_id')->toArray();

                        // Ambil semua InventarisTransaksi yang belum ada di tabel penyusutan
                        return InventarisTransaksi::whereNotIn('id', $usedTransaksiIds)
                            ->get()
                            ->mapWithKeys(function ($transaksi) {
                                return [$transaksi->id => $transaksi->nama_data_inventaris . ' (' . 'Tgl. Pembelian : ' . (new \DateTime($transaksi->tgl_data_inventaris))->format('d/m/Y') . ')'];
                            });
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->getOptionLabelUsing(function ($value) {
                        // Menggunakan ID untuk menampilkan nama_data_inventaris dan tgl_data_inventaris saat edit
                        $transaksi = InventarisTransaksi::find($value);
                        return $transaksi ? $transaksi->nama_data_inventaris . ' (' . 'Tgl. Pembelian : ' . (new \DateTime($transaksi->tgl_data_inventaris))->format('d/m/Y') . ')' : null;
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        // Ambil tgl_data_inventaris dari transaksi terpilih
                        $transaksi = InventarisTransaksi::find($state);
                        if ($transaksi) {
                            $set('nilai_awal', $transaksi->nilai_awal);
                        }
                    }),



                Forms\Components\TextInput::make('nilai_awal')
                    ->label('Nilai Awal')
                    ->prefix('Rp')
                    ->required()
                    ->numeric()
                    ->reactive(),

                Forms\Components\TextInput::make('nilai_penyusutan')
                    ->label('Nilai Penyusutan per Tahun')
                    ->prefix('Rp')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $nilaiAwal = floatval($get('nilai_awal'));
                        $tglDataInventaris = \App\Models\InventarisTransaksi::find($get('inventaris_transaksi_id'))->tgl_data_inventaris;
                        $tglPenyusutan = $get('tgl_penyusutan');

                        if ($nilaiAwal > 0 && floatval($state) > 0 && $tglPenyusutan && $tglDataInventaris) {
                            // Hitung lama penyusutan berdasarkan tahun
                            $lamaPenyusutan = Carbon::parse($tglDataInventaris)->diffInYears(Carbon::parse($tglPenyusutan));
                            $nilaiAkhir = $nilaiAwal - ($state * $lamaPenyusutan);
                            $set('nilai_akhir', round($nilaiAkhir));
                        }
                    }),

                DatePicker::make('tgl_penyusutan')
                    ->label('Tanggal Penyusutan')
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $nilaiAwal = floatval($get('nilai_awal'));
                        $nilaiPenyusutan = floatval($get('nilai_penyusutan'));
                        $tglDataInventaris = \App\Models\InventarisTransaksi::find($get('inventaris_transaksi_id'))->tgl_data_inventaris;

                        if ($nilaiAwal > 0 && $nilaiPenyusutan > 0 && $state && $tglDataInventaris) {
                            // Hitung lama penyusutan berdasarkan tahun
                            $lamaPenyusutan = Carbon::parse($tglDataInventaris)->diffInYears(Carbon::parse($state));
                            $nilaiAkhir = $nilaiAwal - ($nilaiPenyusutan * $lamaPenyusutan);
                            $set('nilai_akhir', round($nilaiAkhir));
                        }
                    }),

                Forms\Components\TextInput::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->prefix('Rp')
                    ->numeric()
                    ->readonly()
                    ->reactive(),

                Textarea::make('keterangan_penyusutan')
                    ->label('Keterangan'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.'),
                Tables\Columns\TextColumn::make('inventarisTransaksi.nama_data_inventaris')->label('Detail Barang')
                    ->description(fn(InventarisPenyusutan $record): string => 'Tgl. Pembelian :' . ' ' . (new \DateTime($record->inventarisTransaksi->tgl_data_inventaris))->format('d/m/Y'), position: 'above')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai_awal')->label('Detail Penyusutan')
                    ->numeric()
                    ->prefix('Rp ')
                    ->sortable()
                    ->description(fn(InventarisPenyusutan $record): string => 'Susut: Rp ' . number_format($record->nilai_penyusutan, 0, ',', ',') . ' /tahun'),

                Tables\Columns\TextColumn::make('nilai_tahunberjalan')
                    ->label('Nilai Berjalan')
                    ->numeric()
                    ->prefix('Rp ')
                    ->getStateUsing(function (InventarisPenyusutan $record) {
                        // Ambil nilai awal dan nilai penyusutan
                        $nilaiAwal = $record->nilai_awal;
                        $nilaiPenyusutan = $record->nilai_penyusutan;

                        // Ambil tanggal data inventaris dan tanggal sekarang
                        $tglDataInventaris = new \DateTime($record->inventarisTransaksi->tgl_data_inventaris);
                        $tahunSekarang = new \DateTime(); // Tanggal hari ini

                        // Hitung selisih tahun (genap)
                        $lamaTahun = $tglDataInventaris->diff($tahunSekarang)->y;

                        // Periksa apakah belum genap satu tahun
                        $tahunBerjalan = $lamaTahun < 1 ? 0 : $lamaTahun;

                        // Hitung nilai tahun berjalan
                        $nilaiTahunBerjalan = $nilaiAwal - ($tahunBerjalan * $nilaiPenyusutan);

                        // Format nilai tahun berjalan dengan pemisah ribuan
                        return number_format($nilaiTahunBerjalan, 0, ',', ',');
                    }),
                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->numeric()
                    ->prefix('Rp ')
                    ->sortable()
                    ->description(fn(InventarisPenyusutan $record): string => 'Susut s.d :' . ' ' . (new \DateTime($record->tgl_penyusutan))->format('d/m/Y'), position: 'above')
                    ->description(fn(InventarisPenyusutan $record): string => $record->keterangan_penyusutan),

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
            'index' => Pages\ListInventarisPenyusutans::route('/'),
            // 'create' => Pages\CreateInventarisPenyusutan::route('/create'),
            // 'edit' => Pages\EditInventarisPenyusutan::route('/{record}/edit'),
        ];
    }
}
