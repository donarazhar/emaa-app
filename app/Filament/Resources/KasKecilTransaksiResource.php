<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\KasKecilTransaksi;
use App\Models\KasKecilMatanggaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KasKecilTransaksiResource\Pages;
use App\Filament\Resources\KasKecilTransaksiResource\RelationManagers;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class KasKecilTransaksiResource extends Resource
{
    protected static ?string $model = KasKecilTransaksi::class;

    protected static ?string $navigationGroup = 'Kas Kecil';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Transaksi Kas Kecils';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kategori')
                    ->default('pengeluaran')->readonly(),
                Forms\Components\Select::make('matanggaran_id')->label('Mata Anggaran')
                    ->label('Mata Anggaran')
                    ->options(function () {
                        // Ambil semua akun anggaran beserta nama akun primary yang terkait
                        return KasKecilMatanggaran::with('aas')
                            ->get()
                            ->pluck('aas.nama_aas', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('jumlah')->required()
                    ->label('Jumlah'),
                Forms\Components\Datepicker::make('tgl_transaksi')->required()
                    ->label('Tanggal Transaksi'),
                Forms\Components\TextArea::make('perincian')->required()
                    ->label('Perincian'),
                Forms\Components\FileUpload::make('foto_kaskecil')
                    ->image()
                    ->multiple()
                    ->directory('file-kaskecil')
                    ->label('Lampiran'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('tgl_transaksi')->dateTime('d/m/Y')->label('Tgl')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.aas.kode_aas')->label('Akun AAS')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.kode_matanggaran')->label('Mata Anggaran')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.aas.nama_aas')->label('Nama Akun')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('perincian')->label('Perincian')->searchable(),
                Tables\Columns\TextColumn::make('matanggaran.aas.status')->label('D/K'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah (Rp)'),
                Tables\Columns\ImageColumn::make('foto_kaskecil')->label('Lampiran')
                    ->stacked()->size(100)->square()->limit(3)->limitedRemainingText(),
            ])
            ->filters([
                DateRangeFilter::make('tgl_transaksi'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
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
            'index' => Pages\ListKasKecilTransaksis::route('/'),
            // 'create' => Pages\CreateKasKecilTransaksi::route('/create'),
            // 'edit' => Pages\EditKasKecilTransaksi::route('/{record}/edit'),
        ];
    }
}
