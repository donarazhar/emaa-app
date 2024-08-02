<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisTransaksiResource\Pages;
use App\Filament\Resources\InventarisTransaksiResource\RelationManagers;
use App\Models\InventarisTransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InventarisTransaksiResource extends Resource
{
    protected static ?string $model = InventarisTransaksi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $modelLabel = 'Transaksi Data Inventaris';
    protected static ?int $navigationSort = 9;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto_data_inventaris')
                    ->image()
                    ->maxSize(1024)
                    ->directory('file-inventaris')
                    ->label('Gambar'),
                Forms\Components\TextInput::make('nama_data_inventaris')->label('Nama Barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jenis_data_inventaris')->label('Jenis Barang')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('stok_data_inventaris')->label('Banyak')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),
                Forms\Components\Textarea::make('keterangan_data_inventaris')->label('Keterangan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_data_inventaris')->label('Tgl Input')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
                    ->required(),
                Forms\Components\Select::make('satuan_id')
                    ->relationship('satuan', 'nama_satuan')
                    ->required(),
                Forms\Components\Select::make('merk_id')
                    ->relationship('merk', 'nama_merk')
                    ->required(),
                Forms\Components\Select::make('bagian_id')
                    ->relationship('bagian', 'nama_bagian')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\ImageColumn::make('foto_data_inventaris')->label('Gambar')->circular(),
                Tables\Columns\TextColumn::make('tgl_data_inventaris')->dateTime('d/m/Y')->label('Tgl. Input'),
                Tables\Columns\TextColumn::make('nama_data_inventaris')->label('Nama Barang'),
                Tables\Columns\TextColumn::make('merk.nama_merk')->label('Merk'),
                Tables\Columns\TextColumn::make('stok_data_inventaris')->label('Byk'),
                Tables\Columns\TextColumn::make('satuan.nama_satuan')->label('Satuan'),
                Tables\Columns\TextColumn::make('bagian.nama_bagian')->label('Lokasi'),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('jenis_data_inventaris')->label('Jenis'),
                Tables\Columns\TextColumn::make('keterangan_data_inventaris')->label('Keterangan'),
            ])
            ->filters([
                DateRangeFilter::make('tgl_data_inventaris'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->color('info'),
                Tables\Actions\EditAction::make()->color('primary'),
                Tables\Actions\DeleteAction::make()->color('danger'),
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
