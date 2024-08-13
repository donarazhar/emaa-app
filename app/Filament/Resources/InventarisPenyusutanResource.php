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
                            ->pluck('nama_data_inventaris', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
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
                            $set('nilai_akhir', round($nilaiAkhir, 2));
                        }
                    }),

                Forms\Components\TextInput::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->prefix('Rp')
                    ->numeric()
                    ->readonly()
                    ->reactive(),

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
                            $set('nilai_akhir', round($nilaiAkhir, 2));
                        }
                    }),

                Textarea::make('keterangan_penyusutan')
                    ->label('Keterangan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inventarisTransaksi.nama_data_inventaris')->label('Nama Barang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai_awal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai_penyusutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_penyusutan')
                    ->date('d/M/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'create' => Pages\CreateInventarisPenyusutan::route('/create'),
            'edit' => Pages\EditInventarisPenyusutan::route('/{record}/edit'),
        ];
    }
}
