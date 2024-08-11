<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KursusPembayaranResource\Pages;
use App\Filament\Resources\KursusPembayaranResource\RelationManagers;
use App\Models\KursusPembayaran;
use App\Models\KursusPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class KursusPembayaranResource extends Resource
{
    protected static ?string $model = KursusPembayaran::class;

    protected static ?string $navigationGroup = 'Kursus Management';
    protected static ?string $navigationIcon = 'heroicon-m-credit-card';
    protected static ?string $modelLabel = 'Transaksi Bayar';
    protected static ?string $navigationLabel = 'Transaksi Bayar';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kursus_pendaftaran_id')
                    ->options(function () {
                        return KursusPendaftaran::all()->pluck('combined_info', 'id');
                    })->searchable()
                    ->label('Transaksi Kursus')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')->label('Tanggal')->required(),

                Forms\Components\TextInput::make('jumlah')->label('Jumlah')->required(),
                Forms\Components\Select::make('metode_pembayaran')->label('Metode Pembayaran')
                    ->options([
                        'Tunai' => 'Tunai',
                        'Transfer Bank' => 'Tranfer Bank',
                        'Kartu Kredit' => 'Kartu Kredit'
                    ])
                    ->required(),
                Forms\Components\Select::make('status')->label('Status')
                    ->options([
                        'Cicil' => 'Cicil',
                        'Lunas' => 'Lunas'
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('foto')
                    ->image()->openable()->downloadable()->directory('file-bayarkursus'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No'),
                Tables\Columns\TextColumn::make('tanggal')->dateTime('d/m/Y')->label('Tanggal'),
                Tables\Columns\TextColumn::make('pendaftaran.combined_info')->searchable()->label('Transaksi Kursus'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah'),
                Tables\Columns\TextColumn::make('metode_pembayaran')->label('Via'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\ImageColumn::make('foto')->label('Bukti Transfer')->circular(),

            ])
            ->filters([
                DateRangeFilter::make('tanggal'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
                ]),
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
            'index' => Pages\ListKursusPembayarans::route('/'),
            // 'create' => Pages\CreateKursusPembayaran::route('/create'),
            // 'edit' => Pages\EditKursusPembayaran::route('/{record}/edit'),
        ];
    }
}
