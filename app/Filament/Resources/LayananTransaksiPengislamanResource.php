<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use App\Models\LayananTransaksiPengislaman;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LayananTransaksiPengislamanResource\Pages;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;
use App\Filament\Resources\LayananTransaksiPengislamanResource\RelationManagers;

class LayananTransaksiPengislamanResource extends Resource
{
    protected static ?string $model = LayananTransaksiPengislaman::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-m-document-magnifying-glass';
    protected static ?string $modelLabel = 'Layanan Pengislaman';
    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_urut')->label('No. Sertifikat')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\Select::make('kategori')->options([
                    'WNI' => 'Warga Negara Indonesia',
                    'WNA' => 'Warga Negara Asing',
                ])->columnSpanFull()->required(),
                Forms\Components\DatePicker::make('tgl')->label('Tanggal')->required(),
                Forms\Components\Select::make('hari')->options([
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                    'Sabtu' => 'Sabtu',
                    'Ahad' => 'Ahad',
                ])->required(),
                Forms\Components\Select::make('jam')->options([
                    '10:00:00' => '10:00',
                    '12:30:00' => '12:30',
                    '14:00:00' => '14:00',
                ])->required(),
                Forms\Components\TextInput::make('nama')->label('Nama Muallaf')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\Select::make('jenkel')->options([
                    'Pria' => '1. Pria',
                    'Wanita' => '2. Wanita',
                ])->required(),
                Forms\Components\TextInput::make('no_hp')->required()->maxLength(255)->numeric(),
                Forms\Components\TextInput::make('email')->label('Email address')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('tlahir')->label('Tmp. Lahir')->required()->maxLength(255),
                Forms\Components\DatePicker::make('tgllahir')->label('TglLahir')->required(),
                Forms\Components\Select::make('agama_semula')
                    ->options([
                        'Kristen' => 'Kristen',
                        'Khatolik' => 'Khatolik',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Khonghucu' => 'Khonghucu',
                        'Ateis' => 'Ateis',
                        '-' => '-',
                    ])->required(),
                Forms\Components\TextInput::make('pekerjaan')->label('Pekerjaan')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\TextInput::make('alamat1')->label('Alamat Jalan')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\TextInput::make('alamat2')->label('Kel-Kec-Prov')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\TextInput::make('nama_baru')->label('Nama Baru')->required()->maxLength(255),
                Forms\Components\TextInput::make('tgl_hijriah')->label('Tgl Hijriah')->required()->maxLength(255),
                Forms\Components\TextInput::make('tahun_hijriah')->label('Tahun Hijriah')->required()->maxLength(255),
                Forms\Components\TextInput::make('saksi1')->label('Saksi #1')->required()->maxLength(255),
                Forms\Components\TextInput::make('saksi2')->label('Saksi #2')->required()->maxLength(255),
                Forms\Components\TextInput::make('saksi3')->label('Saksi #3')->maxLength(255),
                Forms\Components\Textarea::make('alasan')->label('Alasan Masuk Islam')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\Select::make('imam_id')->label('Imam Pengislaman')
                    ->relationship('imam', 'nama_imam')->columnSpanFull()
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')->rowIndex(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Muallaf')->sortable()->searchable()
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->agama_semula)
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->jenkel, position: 'above'),
                Tables\Columns\TextColumn::make('email')->label('Detail Kontak')->toggleable(isToggledHiddenByDefault: true)->description(fn(LayananTransaksiPengislaman $record): string => $record->no_hp),
                Tables\Columns\TextColumn::make('tgl')->dateTime('d/m/Y')->label('Detail Booking')->sortable()->searchable()
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->hari, position: 'above')
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->jam),
                Tables\Columns\TextColumn::make('imam.nama_imam')->label('Detail Pelaksanaan')
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->alasan)
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->kategori, position: 'above'),
                Tables\Columns\TextColumn::make('alamat1')->label('Detail Personal')->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->pekerjaan, position: 'above')
                    ->description(fn(LayananTransaksiPengislaman $record): string => $record->alamat2),

            ])
            ->filters([
                SelectFilter::make('jenkel')
                    ->options([
                        'Pria' => '1. Pria',
                        'Wanita' => '2. Wanita',
                    ])->label('Filter by Jenis Kelamin'),
                SelectFilter::make('imam.nama_imam')
                    ->relationship('imam', 'nama_imam')->label('Filter by Konsultan'),
                SelectFilter::make('agama_semula')
                    ->options([
                        'Kristen' => 'Kristen',
                        'Khatolik' => 'Khatolik',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Khonghucu' => 'Khonghucu',
                        'Ateis' => 'Ateis',
                        '-' => '-',
                    ])->label('Filter by Agama Semula'),

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Lengkap')
                    ->description('Informasi lengkap data pengislaman')
                    ->icon('heroicon-s-circle-stack')
                    ->collapsible()
                    ->headerActions([
                        Action::make('Export File')
                            ->icon('heroicon-m-printer')
                            ->url(fn($record) => route('pdf.previewpengislaman', ['id' => $record->id]))
                            ->openUrlInNewTab(true)
                            ->iconButton()
                            ->size(ActionSize::Large)
                            ->tooltip('Print PDF'),
                    ])
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('no_urut')
                                    ->label('No. Sertifikat')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('kategori')
                                    ->label('Kategori')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('tgl')
                                    ->label('Tanggal')
                                    ->weight(FontWeight::Bold)
                                    ->dateTime('d/m/Y'),
                                TextEntry::make('hari')
                                    ->label('Hari')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('jam')
                                    ->label('Jam')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-clock'),
                                TextEntry::make('nama')
                                    ->label('Nama Muallaf')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('jenkel')
                                    ->label('Jenis Kelamin')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('no_hp')
                                    ->label('No HP')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('email')
                                    ->label('Email')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('tlahir')
                                    ->label('Tempat Lahir')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('tgllahir')
                                    ->label('Tanggal Lahir')
                                    ->weight(FontWeight::Bold)
                                    ->dateTime('d/m/Y'),
                                TextEntry::make('agama_semula')
                                    ->label('Agama Semula')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('pekerjaan')
                                    ->label('Pekerjaan')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('alamat1')
                                    ->label('Alamat Jalan')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('alamat2')
                                    ->label('Kel-Kec-Prov')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('nama_baru')
                                    ->label('Nama Baru')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('tgl_hijriah')
                                    ->label('Tanggal Hijriah')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('tahun_hijriah')
                                    ->label('Tahun Hijriah')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('saksi1')
                                    ->label('Saksi #1')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('saksi2')
                                    ->label('Saksi #2')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('saksi3')
                                    ->label('Saksi #3')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('imam.nama_imam')
                                    ->label('Imam Pengislaman')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-users'),
                                TextEntry::make('alasan')
                                    ->label('Alasan Masuk Islam')
                                    ->weight(FontWeight::Bold)
                                    ->columnSpanFull(),
                            ])
                            ->columns(4),
                    ]),

                // Section 2 Preview PDF
                Section::make('Preview Data')
                    ->description('Lihat data pengislaman dengan PDF')
                    ->collapsed()
                    ->schema([
                        PdfViewerEntry::make('file')
                            ->label('')
                            ->minHeight('100svh')
                            ->fileUrl(function ($record) {
                                return route('pdf.previewpengislaman', ['id' => $record->id]);
                            })
                            ->columnSpanFull()
                            ->schema([])
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
