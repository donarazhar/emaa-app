<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SuratTransaksi;
use Filament\Resources\Resource;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Resources\SuratTransaksiResource\Pages;

class SuratTransaksiResource extends Resource
{
    protected static ?string $model = SuratTransaksi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    protected static ?string $modelLabel = 'Persuratans';
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('index')->label('No Disposisi')
                    ->disabled()
                    ->default(fn () => \App\Models\SuratTransaksi::generateNoUrutSurat()),
                Forms\Components\TextInput::make('no_transaksi_surat')->label('No. Surat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_transaksi_surat')->label('Tgl.')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\Textarea::make('perihal_transaksi_surat')->label('Perihal')
                    ->required()->rows(2)
                    ->maxLength(255),
                Forms\Components\TextInput::make('surat_dari_transaksi_surat')->label('Surat dari')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_transaksi_surat')
                    ->label('Status')
                    ->options([
                        'Disposisi' => 'Disposisi',
                        'Proses' => 'Proses',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(),
                Forms\Components\Select::make('kategori_surat_id')->label('Kategori Surat')
                    ->relationship('kategori', 'nama_kategori')
                    ->required(),
                Forms\Components\Select::make('asal_surat_id')->label('Asal Surat')
                    ->relationship('asal', 'nama_asal_surat')
                    ->required(),
                Forms\Components\Textarea::make('disposisi_transaksi_surat')->label('Isi Disposisi')
                    ->required()->rows(5)->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')->rowIndex(),
                Tables\Columns\TextColumn::make('no_disposisi')->label('No. Disposisi')
                    ->getStateUsing(function ($record) {
                        $currentNumber = intval(explode('/', \App\Models\SuratTransaksi::generateNoUrutSurat())[0]);
                        $adjustedNumber = $currentNumber - 1;
                        $month = date('m');
                        $year = date('Y');
                        return str_pad($adjustedNumber, 4, '0', STR_PAD_LEFT) . '/' . $month . '/' . $year;
                    }),
                Tables\Columns\TextColumn::make('tgl_transaksi_surat')->dateTime('d/m/Y')->label('Tgl & No. Surat')
                    ->description(fn (SuratTransaksi $record): string => $record->no_transaksi_surat)
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('surat_dari_transaksi_surat')->label('Dari & Perihal')
                    ->description(fn (SuratTransaksi $record): string => $record->perihal_transaksi_surat)
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')->label('Kategori')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('asal.nama_asal_surat')->label('Asal')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_transaksi_surat')->label('Status')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('disposisi_transaksi_surat')->label('Isi Disposisi')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('nama_asal_surat')->label('Filter by Asal Surat')
                    ->relationship('asal', 'nama_asal_surat'),
                Tables\Filters\SelectFilter::make('nama_kategori')->label('Filter by Kategori Surat')
                    ->relationship('kategori', 'nama_kategori'),
                Tables\Filters\SelectFilter::make('status_transaksi_surat')->label('Filter by Status Surat')
                    ->options([
                        'Disposisi' => 'Disposisi',
                        'Proses' => 'Proses',
                        'Selesai' => 'Selesai',
                    ]),
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
            'index' => Pages\ListSuratTransaksis::route('/'),
            // 'create' => Pages\CreateSuratTransaksi::route('/create'),
            // 'edit' => Pages\EditSuratTransaksi::route('/{record}/edit'),
        ];
    }
}
