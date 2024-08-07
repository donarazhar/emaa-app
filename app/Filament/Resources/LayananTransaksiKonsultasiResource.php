<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\LayananTransaksiKonsultasi;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LayananTransaksiKonsultasiResource\Pages;
use App\Filament\Resources\LayananTransaksiKonsultasiResource\RelationManagers;

class LayananTransaksiKonsultasiResource extends Resource
{
    protected static ?string $model = LayananTransaksiKonsultasi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $modelLabel = 'Layanan Konsultasi';
    protected static ?int $navigationSort = 4;

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
                        '10:00:00' => '10:00',
                        '12:30:00' => '12:30',
                        '14:00:00' => '14:00',
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
                Forms\Components\DatePicker::make('tgl_lahir_jamaah')->maxDate(now()->subYears(20))->label('Tgl Lahir')
                    ->required(),
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
                Forms\Components\Select::make('imam_id')->label('Konsultan')
                    ->relationship('imam', 'nama_imam')
                    ->required(),
                Forms\Components\Select::make('jeniskonsultasi_id')->label('Jenis Kosultasi')
                    ->relationship('jeniskonsultasi', 'nama_jenis_konsultasi')
                    ->required(),
                Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')
                    ->required()->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextArea::make('deskripsi_masalah')->label('Deskripsi Masalah')
                    ->required()
                    ->maxLength(255)->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->rowIndex()->label('No.'),
                Tables\Columns\TextColumn::make('nama_jamaah')->label('Nama Jamaah')->sortable()->searchable()
                    ->description(fn (LayananTransaksiKonsultasi $record): string => $record->jenkel_jamaah),
                Tables\Columns\TextColumn::make('tgl_booking')->dateTime('d/m/Y')
                    ->label('Detail Booking')
                    ->description(fn (LayananTransaksiKonsultasi $record): string => $record->jam_booking, position: 'above')
                    ->description(fn (LayananTransaksiKonsultasi $record): string => $record->imam->nama_imam)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jeniskonsultasi.nama_jenis_konsultasi')->label('Detail Masalah')
                    ->description(fn (LayananTransaksiKonsultasi $record): string => $record->deskripsi_masalah),
                Tables\Columns\TextColumn::make('email')->label('Detail Kontak')->toggleable(isToggledHiddenByDefault: true)->description(fn (LayananTransaksiKonsultasi $record): string => $record->no_hp),
                Tables\Columns\TextColumn::make('pekerjaan')->label('Detail Personal')->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn (LayananTransaksiKonsultasi $record): string => $record->pendidikan, position: 'above')
                    ->description(fn (LayananTransaksiKonsultasi $record): string => $record->alamat),
            ])
            ->filters([
                SelectFilter::make('jenkel_jamaah')
                    ->options([
                        'Pria' => 'Pria',
                        'Wanita' => 'Wanita',
                    ])->label('Filter by Jenis Kelamin'),
                SelectFilter::make('imam.nama_imam')
                    ->relationship('imam', 'nama_imam')->label('Filter by Konsultan'),
                SelectFilter::make('nama_jenis_konsultasi')
                    ->relationship('jeniskonsultasi', 'nama_jenis_konsultasi')->label('Filter by Permasalahan'),

            ], layout: FiltersLayout::AboveContentCollapsible)->filtersFormColumns(3)
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
            'index' => Pages\ListLayananTransaksiKonsultasis::route('/'),
            // 'create' => Pages\CreateLayananTransaksiKonsultasi::route('/create'),
            // 'edit' => Pages\EditLayananTransaksiKonsultasi::route('/{record}/edit'),
        ];
    }
}
