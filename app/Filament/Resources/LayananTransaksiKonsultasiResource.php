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
use Filament\Infolists\Components\Group;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Validator;
use App\Models\LayananTransaksiKonsultasi;
use Filament\Infolists\Components\Section;
use Filament\Resources\Pages\CreateRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use App\Filament\Resources\LayananTransaksiKonsultasiResource\Pages;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class LayananTransaksiKonsultasiResource extends Resource
{
    protected static ?string $model = LayananTransaksiKonsultasi::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-m-chat-bubble-left-ellipsis';
    protected static ?string $modelLabel = 'Layanan Konsultasi';
    protected static ?int $navigationSort = 4;

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
                Forms\Components\DatePicker::make('tgl_booking')
                    ->label('Tanggal Konsultasi')->reactive()->required(),
                Forms\Components\Select::make('jam_booking')
                    ->label('Jam Konsultasi')
                    ->options(function (callable $get, $record) {
                        $selectedDate = $get('tgl_booking');
                        if ($selectedDate) {
                            $bookedTimes = LayananTransaksiKonsultasi::where('tgl_booking', $selectedDate)
                                ->when($record, function ($query, $record) {
                                    // Exclude the current record's time slot
                                    return $query->where('id', '!=', $record->id);
                                })
                                ->pluck('jam_booking')
                                ->toArray();

                            $allTimes = [
                                '10:00:00' => '10:00',
                                '12:30:00' => '12:30',
                                '14:00:00' => '14:00',
                            ];

                            foreach ($bookedTimes as $bookedTime) {
                                unset($allTimes[$bookedTime]);
                            }

                            return $allTimes;
                        }

                        return [
                            '10:00:00' => '10:00',
                            '12:30:00' => '12:30',
                            '14:00:00' => '14:00',
                        ];
                    })
                    ->required(),
                Forms\Components\TextInput::make('nama_jamaah')->label('Nama')
                    ->required()->maxLength(255),
                Forms\Components\Select::make('jenkel_jamaah')
                    ->options([
                        'Pria' => 'Pria',
                        'Wanita' => 'Wanita',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir_jamaah')->label('Tempat lahir')
                    ->required()->maxLength(255),
                Forms\Components\DatePicker::make('tgl_lahir_jamaah')->maxDate(now()->subYears(20))->label('Tgl Lahir')
                    ->required(),
                Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')
                    ->required()->columnSpanFull()->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->required()->maxLength(255)->numeric(),
                Forms\Components\TextInput::make('pendidikan')->label('Pendidikan')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('pekerjaan')->label('Pekerjaan')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email address')->email()
                    ->required()->maxLength(255),
                Forms\Components\Select::make('imam_id')->label('Konsultan')
                    ->relationship('imam', 'nama_imam')
                    ->required(),
                Forms\Components\Select::make('jeniskonsultasi_id')->label('Jenis Kosultasi')
                    ->relationship('jeniskonsultasi', 'nama_jenis_konsultasi')
                    ->required(),
                Forms\Components\TextArea::make('deskripsi_masalah')->label('Deskripsi Masalah')
                    ->required()->maxLength(255)->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')->rowIndex(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Lengkap')
                    ->description('Informasi lengkap data konsultasi')
                    ->icon('heroicon-s-circle-stack')
                    ->collapsible()
                    ->headerActions([
                        Action::make('Export File')
                            ->icon('heroicon-m-printer')
                            ->url(fn ($record) => route('pdf.previewkonsultasi', ['id' => $record->id]))
                            ->openUrlInNewTab(true)
                            ->iconButton()
                            ->size(ActionSize::Large)
                            ->tooltip('Print PDF'),
                    ])
                    ->schema([
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema([
                                TextEntry::make('tgl_booking')
                                    ->label('Tanggal Booking')
                                    ->dateTime('d/m/Y')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-calendar-days'),
                                TextEntry::make('jam_booking')
                                    ->label('Jam Booking')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-clock'),
                                TextEntry::make('jeniskonsultasi.nama_jenis_konsultasi')
                                    ->label('Jenis Konsultasi')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('imam.nama_imam')
                                    ->label('Konsultan')
                                    ->weight(FontWeight::Bold)
                                    ->icon('heroicon-m-users'),

                            ])->columns(4),
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema(
                                [
                                    TextEntry::make('nama_jamaah')
                                        ->label('Nama Jamaah')
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-m-users'),
                                    TextEntry::make('jenkel_jamaah')
                                        ->label('Jenis Kelamin')
                                        ->weight(FontWeight::Bold),
                                    TextEntry::make('tempat_lahir_jamaah')
                                        ->weight(FontWeight::Bold)
                                        ->label('Tempat Lahir'),
                                    TextEntry::make('tgl_lahir_jamaah')
                                        ->label('Tanggal Lahir')
                                        ->weight(FontWeight::Bold)
                                        ->dateTime('d/m/Y'),
                                ]
                            )->columns(4),

                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema(
                                [
                                    TextEntry::make('email')
                                        ->label('Email')
                                        ->weight(FontWeight::Bold),
                                    TextEntry::make('no_hp')
                                        ->label('No HP')
                                        ->weight(FontWeight::Bold),
                                    TextEntry::make('pendidikan')
                                        ->label('Pendidikan')
                                        ->weight(FontWeight::Bold),
                                    TextEntry::make('pekerjaan')
                                        ->label('Pekerjaan')
                                        ->weight(FontWeight::Bold),
                                ]
                            )->columns(4),
                        TextEntry::make('alamat')
                            ->label('Alamat Lengkap')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('deskripsi_masalah')
                            ->weight(FontWeight::Bold)
                            ->label('Deskripsi Masalah'),
                    ]),

                // Section 2 Preview PDF
                Section::make('Preview Data')
                    ->description('Lihat data konsultasi dengan PDF')
                    ->collapsed()
                    ->schema([
                        PdfViewerEntry::make('file')
                            ->label('')
                            ->minHeight('100svh')
                            ->fileUrl(function ($record) {
                                return route('pdf.previewkonsultasi', ['id' => $record->id]);
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
            'index' => Pages\ListLayananTransaksiKonsultasis::route('/'),
            // 'create' => Pages\CreateLayananTransaksiKonsultasi::route('/create'),
            // 'edit' => Pages\EditLayananTransaksiKonsultasi::route('/{record}/edit'),
        ];
    }
}

class CreateBooking extends CreateRecord
{
    protected static string $resource = LayananTransaksiKonsultasiResource::class;

    protected function beforeValidate()
    {
        $data = $this->form->getState();

        $validator = Validator::make($data, [
            'tgl_booking' => 'required|date',
            'jam_booking' => 'required',
        ]);

        $validator->after(function ($validator) use ($data) {
            $exists = LayananTransaksiKonsultasi::where('tgl_booking', $data['tgl_booking'])
                ->where('jam_booking', $data['jam_booking'])
                ->exists();

            if ($exists) {
                $validator->errors()->add('jam_booking', 'Tanggal dan jam ini sudah terbooking.');
            }
        });

        $validator->validate();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('tgl_booking')
                ->reactive()
                ->label('Tanggal Konsultasi')
                ->required(),
            Forms\Components\Select::make('jam_booking')
                ->options([
                    '10:00:00' => '10:00',
                    '12:30:00' => '12:30',
                    '14:00:00' => '14:00',
                ])
                ->required(),
        ];
    }
}

class EditBooking extends EditRecord
{
    protected static string $resource = LayananTransaksiKonsultasiResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('tgl_booking')
                ->reactive()
                ->label('Tanggal Konsultasi')
                ->required(),
            Forms\Components\Select::make('jam_booking')
                ->options(function (callable $get, $record) {
                    $selectedDate = $get('tgl_booking');
                    if ($selectedDate) {
                        $bookedTimes = LayananTransaksiKonsultasi::where('tgl_booking', $selectedDate)
                            ->when($record, function ($query, $record) {
                                // Exclude the current record's time slot
                                return $query->where('id', '!=', $record->id);
                            })
                            ->pluck('jam_booking')
                            ->toArray();

                        $allTimes = [
                            '10:00:00' => '10:00',
                            '12:30:00' => '12:30',
                            '14:00:00' => '14:00',
                        ];

                        foreach ($bookedTimes as $bookedTime) {
                            unset($allTimes[$bookedTime]);
                        }

                        return $allTimes;
                    }

                    return [
                        '10:00:00' => '10:00',
                        '12:30:00' => '12:30',
                        '14:00:00' => '14:00',
                    ];
                })
                ->required(),
        ];
    }
}
