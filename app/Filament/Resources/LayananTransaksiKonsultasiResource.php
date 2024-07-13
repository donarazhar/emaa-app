<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananTransaksiKonsultasiResource\Pages;
use App\Filament\Resources\LayananTransaksiKonsultasiResource\RelationManagers;
use App\Models\LayananTransaksiKonsultasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LayananTransaksiKonsultasiResource extends Resource
{
    protected static ?string $model = LayananTransaksiKonsultasi::class;

    protected static ?string $navigationGroup = 'Layanan';
    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $modelLabel = 'Transaksi Konsultasi';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tgl_booking')->label('Tanggal Konsultasi')
                    ->required(),
                Forms\Components\Select::make('jam_booking')
                    ->options([
                        '10:00' => '10:00',
                        '12:30' => '12:30',
                        '14:00' => '14:00',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('nama_jamaah')->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenkel_jamaah')
                    ->options([
                        'Pria' => 'Pria',
                        'Wanita' => 'Wanita',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir_jamaah')->label('Tempat lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_lahir_jamaah')->label('Tgl Lahir')
                    ->required(),
                Forms\Components\TextArea::make('alamat')->label('Alamat Lengkap')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(255)
                    ->numeric(),
                Forms\Components\TextInput::make('pendidikan')->label('Pendidikan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pekerjaan')->label('Pekerjaan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('deskripsi_masalah')->label('Deskripsi Masalah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('imam_id')->label('Konsultan')
                    ->relationship('imam', 'nama_imam')
                    ->required(),
                Forms\Components\Select::make('jeniskonsultasi_id')->label('Jenis Kosultasi')
                    ->relationship('jeniskonsultasi', 'nama_jenis_konsultasi')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama_jamaah')->label('Nama'),
                Tables\Columns\TextColumn::make('tgl_booking')->dateTime('d/m/Y')->label('Tgl. Booking')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jam_booking')->label('Jam')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenkel_jamaah')->label('Jenkel')->searchable(),
                Tables\Columns\TextColumn::make('imam.nama_imam')->label('Konsultan'),
                Tables\Columns\TextColumn::make('jeniskonsultasi.nama_jenis_konsultasi')->label('Jenis'),
                Tables\Columns\TextColumn::make('deskripsi_masalah')->label('Deskripsi'),
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
            'index' => Pages\ListLayananTransaksiKonsultasis::route('/'),
            // 'create' => Pages\CreateLayananTransaksiKonsultasi::route('/create'),
            // 'edit' => Pages\EditLayananTransaksiKonsultasi::route('/{record}/edit'),
        ];
    }
}
