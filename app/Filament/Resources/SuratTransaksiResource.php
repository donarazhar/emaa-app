<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratTransaksiResource\Pages;
use App\Filament\Resources\SuratTransaksiResource\RelationManagers;
use App\Models\SuratTransaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratTransaksiResource extends Resource
{
    protected static ?string $model = SuratTransaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationGroup = 'Transaksi Surat';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Transaksi Data Surat';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_transaksi_surat')->label('No Urut')
                    ->readOnly()
                    ->default(fn () => \App\Models\SuratTransaksi::generateNoUrutSurat()),
                Forms\Components\DatePicker::make('tgl_transaksi_surat')->label('Tgl Input')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('perihal_transaksi_surat')->label('Perihal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('surat_dari_transaksi_surat')->label('Surat dari')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('disposisi_transaksi_surat')->label('Isi Disposisi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_transaksi_surat')
                    ->label('Status')
                    ->options([
                        'disposisi' => 'Disposisi',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                    ])
                    ->required(),
                Forms\Components\Select::make('kategori_surat_id')->label('Kategori Surat')
                    ->relationship('kategori', 'nama_kategori')
                    ->required(),
                Forms\Components\Select::make('asal_surat_id')->label('Asal Surat')
                    ->relationship('asal', 'nama_asal_surat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('no_transaksi_surat')->label('No Urut'),
                Tables\Columns\TextColumn::make('tgl_transaksi_surat')->dateTime('d/m/Y')->label('Tgl. Input'),
                Tables\Columns\TextColumn::make('perihal_transaksi_surat')->label('Perihal'),
                Tables\Columns\TextColumn::make('surat_dari_transaksi_surat')->label('Surat dari'),
                Tables\Columns\TextColumn::make('disposisi_transaksi_surat')->label('Isi Disposisi'),
                Tables\Columns\TextColumn::make('status_transaksi_surat')->label('Status'),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')->label('Kategori Surat'),
                Tables\Columns\TextColumn::make('asal.nama_asal_surat')->label('Asal Surat'),
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
            'index' => Pages\ListSuratTransaksis::route('/'),
            'create' => Pages\CreateSuratTransaksi::route('/create'),
            'edit' => Pages\EditSuratTransaksi::route('/{record}/edit'),
        ];
    }
}
