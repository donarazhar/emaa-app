<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisTransaksiResource\Pages;
use App\Models\InventarisTransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InventarisTransaksiResource extends Resource
{
    protected static ?string $model = InventarisTransaksi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-m-inbox-stack';
    protected static ?string $modelLabel = 'Inventaris';
    protected static ?int $navigationSort = 9;

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
                Forms\Components\FileUpload::make('foto_data_inventaris')
                    ->label('Gambar')
                    ->image()
                    ->imageEditor()
                    ->multiple()
                    ->directory('file-inventaris'),

                Forms\Components\TextInput::make('kode_barang')
                    ->label('Kode Barang')
                    ->readOnly() // Kode barang diisi otomatis, tidak perlu diinput manual
                    ->default(fn($record) => $record ? $record->kode_barang : null)
                    ->afterStateHydrated(fn($state, callable $set, $record) => $record ? $set('kode_barang', $record->kode_barang) : null),

                Forms\Components\TextInput::make('nama_data_inventaris')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('jenis_data_inventaris')
                    ->label('Jenis Barang')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('jenis_transaksi')
                    ->options([
                        'masuk' => 'Masuk',
                        'keluar' => 'Keluar',
                        'pindah' => 'Pindah',
                    ])
                    ->label('Jenis Transaksi')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'baik' => 'Baik',
                        'rusak' => 'Rusak',
                        'repair' => 'Repair',
                    ])
                    ->label('Status Barang')
                    ->required(),

                Forms\Components\TextInput::make('stok_data_inventaris')
                    ->label('Banyak')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),

                Forms\Components\Textarea::make('keterangan_data_inventaris')
                    ->label('Keterangan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tgl_data_inventaris')
                    ->label('Tgl. Pembelian')
                    ->required()
                    ->maxDate(now()),

                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
                    ->label('Kategori')
                    ->required(),

                Forms\Components\Select::make('satuan_id')
                    ->relationship('satuan', 'nama_satuan')
                    ->label('Satuan')
                    ->required(),

                Forms\Components\Select::make('merk_id')
                    ->relationship('merk', 'nama_merk')
                    ->label('Merk')
                    ->required(),

                Forms\Components\Select::make('bagian_id')
                    ->relationship('bagian', 'nama_bagian')
                    ->label('Bagian')
                    ->required(),

                Forms\Components\Select::make('suplier_id')
                    ->relationship('suplier', 'nama_suplier')
                    ->label('Suplier')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No.'),
                Tables\Columns\ImageColumn::make('foto_data_inventaris')
                    ->label('Gambar')
                    ->circular()
                    ->size(60)
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),

                Tables\Columns\TextColumn::make('kode_barang')
                    ->label('Detail Kode Barang')
                    ->searchable()
                    ->description(fn(InventarisTransaksi $record): string => 'Tgl. Pembelian :' . ' ' . (new \DateTime($record->tgl_data_inventaris))->format('d/m/Y'), position: 'above')
                    ->description(fn(InventarisTransaksi $record): string => 'Inv :' . ' ' . $record->jenis_transaksi),

                Tables\Columns\TextColumn::make('nama_data_inventaris')
                    ->label('Detail Barang')
                    ->description(fn(InventarisTransaksi $record): string => $record->merk->nama_merk, position: 'above')
                    ->description(fn(InventarisTransaksi $record): string => 'Banyak: ' . $record->stok_data_inventaris . ' ' . $record->satuan->nama_satuan),

                Tables\Columns\TextColumn::make('bagian.nama_bagian')
                    ->label('Detail Kategori')
                    ->description(fn(InventarisTransaksi $record): string => $record->kategori->nama_kategori, position: 'above')
                    ->description(fn(InventarisTransaksi $record): string => $record->jenis_data_inventaris),

                Tables\Columns\TextColumn::make('penyusutan.nilai_awal')
                    ->label('Detail Harga Barang')
                    ->prefix('Rp')
                    ->numeric()
                    ->description(
                        fn(InventarisTransaksi $record): string => $record->keterangan_data_inventaris
                    ),

                Tables\Columns\TextColumn::make('penyusutan.keterangan_penyusutan')
                    ->label('Detail Penyusutan')
                    ->description(fn(InventarisTransaksi $record): string => 'Kondisi :' . ' ' . $record->status)
                    ->description(
                        fn(InventarisTransaksi $record): string =>
                        $record->penyusutan
                            ? 'Susut s.d : ' . (new \DateTime($record->penyusutan->tgl_penyusutan))->format('d/m/Y')
                            : 'Susut s.d : -',
                        position: 'above'
                    ),

                Tables\Columns\TextColumn::make('nilai_tahunberjalan')
                    ->label('Detail Nilai Penyusutan')
                    ->numeric()
                    ->getStateUsing(function (InventarisTransaksi $record) {
                        // Periksa apakah penyusutan tersedia
                        if ($record->penyusutan) {
                            // Ambil nilai awal dan nilai penyusutan
                            $nilaiAwal = $record->penyusutan->nilai_awal;
                            $nilaiPenyusutan = $record->penyusutan->nilai_penyusutan;

                            // Ambil tanggal data inventaris dan tanggal sekarang
                            $tglDataInventaris = new \DateTime($record->tgl_data_inventaris);
                            $tahunSekarang = new \DateTime(); // Tanggal hari ini

                            // Hitung selisih tahun (genap)
                            $lamaTahun = $tglDataInventaris->diff($tahunSekarang)->y;

                            // Periksa apakah belum genap satu tahun
                            $tahunBerjalan = $lamaTahun < 1 ? 0 : $lamaTahun;

                            // Hitung nilai tahun berjalan
                            $nilaiTahunBerjalan = $nilaiAwal - ($tahunBerjalan * $nilaiPenyusutan);

                            // Format nilai tahun berjalan dengan pemisah ribuan
                            return 'Rp ' . number_format($nilaiTahunBerjalan, 0, ',', ',');
                        }

                        // Jika tidak ada penyusutan, kembalikan nilai default atau 0
                        return 'Rp 0';
                    })

                    ->description(
                        fn(InventarisTransaksi $record): string =>
                        $record->penyusutan
                            ? 'Susut/Tahun : Rp ' . number_format($record->penyusutan->nilai_penyusutan, 0, ',', ',')
                            : 'Susut/Tahun : 0',
                        position: 'above'
                    )
                    ->description(
                        fn(InventarisTransaksi $record): string =>
                        $record->penyusutan
                            ? 'Nilai Akhir : Rp ' . number_format($record->penyusutan->nilai_akhir, 0, ',', ',')
                            : 'Nilai Akhir : 0'
                    ),

            ])
            ->filters([
                DateRangeFilter::make('tgl_data_inventaris'),
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
            'index' => Pages\ListInventarisTransaksis::route('/'),
            // 'create' => Pages\CreateInventarisTransaksi::route('/create'),
            // 'edit' => Pages\EditInventarisTransaksi::route('/{record}/edit'),
        ];
    }
}
