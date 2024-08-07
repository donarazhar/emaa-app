<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananTransaksiPengislamanResource\Pages;
use App\Filament\Resources\LayananTransaksiPengislamanResource\RelationManagers;
use App\Models\LayananTransaksiPengislaman;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LayananTransaksiPengislamanResource extends Resource
{
    protected static ?string $model = LayananTransaksiPengislaman::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?string $modelLabel = 'Layanan Pengislaman';
    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_urut')->label('No. Sertifikat')->required()->maxLength(255),
                Forms\Components\DatePicker::make('tgl')->label('Tanggal')->required(),
                Forms\Components\Select::make('kategori')->options([
                    'WNI' => 'Warga Negara Indonesia',
                    'WNA' => 'Warga Negara Asing',
                ])->required(),
                Forms\Components\Select::make('jam')->options([
                    '10:00' => '10:00',
                    '12:30' => '12:30',
                    '14:00' => '14:00',
                ])->required(),
                Forms\Components\Select::make('hari')->options([
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                    'Sabtu' => 'Sabtu',
                    'Ahad' => 'Ahad',
                ])->required(),
                Forms\Components\TextInput::make('nama')->label('Nama Muallaf')->required()->maxLength(255),             Forms\Components\Select::make('jenkel')->options([
                    'Laki-Laki' => 'Laki-Laki',
                    'Perempuan' => 'Perempuan',
                ])->required(),
                Forms\Components\TextInput::make('no_hp')->required()->maxLength(255)->numeric(),
                Forms\Components\TextInput::make('email')->label('Email address')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('tlahir')->label('TLahir')->required()->maxLength(255),
                Forms\Components\DatePicker::make('tgllahir')->label('TglLahir')->required(),
                Forms\Components\Select::make('agama_semula')->options([
                    'Kristen' => 'Kristen',
                    'Khatolik' => 'Khatolik',
                    'Hindu' => 'Hindu',
                    'Budha' => 'Budha',
                    'Khonghucu' => 'Khonghucu',
                    'Ateis' => 'Ateis',
                    '-' => '-',
                ])->required(),
                Forms\Components\TextInput::make('pekerjaan')->label('Pekerjaan')->required()->maxLength(255),
                Forms\Components\TextInput::make('alamat1')->label('Alamat Jalan')->required()->maxLength(255),
                Forms\Components\TextInput::make('alamat2')->label('Kel-Kec-Prov')->required()->maxLength(255),
                Forms\Components\TextInput::make('nama_baru')->label('Nama Baru')->required()->maxLength(255),
                Forms\Components\TextInput::make('tgl_hijriah')->label('Tgl Hijriah')->required()->maxLength(255),
                Forms\Components\TextInput::make('tahun_hijriah')->label('Tahun Hijriah')->required()->maxLength(255),
                Forms\Components\TextInput::make('saksi1')->label('Saksi #1')->required()->maxLength(255),
                Forms\Components\TextInput::make('saksi2')->label('Saksi #2')->required()->maxLength(255),
                Forms\Components\TextInput::make('saksi3')->label('Saksi #3')->required()->maxLength(255),
                Forms\Components\Textarea::make('alasan')->label('Alasan')->required()->maxLength(255),
                Forms\Components\Select::make('imam_id')->label('Imam Pengislaman')
                    ->relationship('imam', 'nama_imam')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama')->label('Nama Muallaf'),
                Tables\Columns\TextColumn::make('tgl')->dateTime('d/m/Y')->label('Tgl. Pengislaman')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jam')->label('Jam')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('imam.nama_imam')->label('Imam Pengislaman'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLayananTransaksiPengislamen::route('/'),
            // 'create' => Pages\CreateLayananTransaksiPengislaman::route('/create'),
            // 'edit' => Pages\EditLayananTransaksiPengislaman::route('/{record}/edit'),
        ];
    }
}
