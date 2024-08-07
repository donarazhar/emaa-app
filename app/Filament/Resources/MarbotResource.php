<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Marbot;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\MarbotResource\Pages;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use App\Filament\Resources\MarbotResource\RelationManagers;
use Illuminate\Database\Eloquent\Builder;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;
use Illuminate\Support\Facades\Auth;


class MarbotResource extends Resource
{
    protected static ?string $model = Marbot::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Marbot';
    protected static ?string $navigationLabel = 'Marbot';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section 1 Data Personal
                Forms\Components\Section::make('Personal Information')
                    ->description('Enter your details data')
                    ->collapsible()
                    ->schema([
                        // Wizard Component - Membuat Tabs Menu
                        Forms\Components\Wizard::make([

                            // First Information Tab
                            Forms\Components\Wizard\Step::make('First Information')
                                ->schema([
                                    Forms\Components\FileUpload::make('foto')->label('Foto Profile')
                                        ->image()->openable()->downloadable()->directory('file-marbot'),
                                    Forms\Components\Select::make('email_user')->label('Users Akun')
                                        ->relationship('user', 'name')->required(),
                                    Forms\Components\TextInput::make('nip')->label('NIP')
                                        ->numeric()->maxLength(15)->unique(ignoreRecord: true)->required(),
                                    Forms\Components\TextInput::make('phone')->label('No. HP')
                                        ->numeric()->maxLength(15)->unique(ignoreRecord: true)->required(),
                                    Forms\Components\Select::make('jenkel')->label('Jenkel')->options([
                                        'Laki-Laki' => 'Laki-Laki',
                                        'Perempuan' => 'Perempuan',
                                    ])->required(),
                                    Forms\Components\TextInput::make('tlahir')
                                        ->label('Tmp. Lahir'),
                                    Forms\Components\DatePicker::make('tgl_lahir')->label('Tgl. Lahir')
                                        ->maxDate(now()->subYears(20)),
                                    Forms\Components\Select::make('goldar')->label('Goldar')->options([
                                        'O' => 'O',
                                        'A' => 'A',
                                        'AB' => 'AB',
                                        'B' => 'B',
                                    ]),
                                ])
                                ->columns(2)
                                ->description('Enter your details')
                                ->icon('heroicon-o-users'),

                            // Twice Information Tab
                            Forms\Components\Wizard\Step::make('Twice Information')
                                ->schema([
                                    Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')
                                        ->maxLength(255)->rows(4)->columnSpanFull(),
                                    Forms\Components\Grid::make()
                                        ->schema([
                                            Forms\Components\Select::make('status_nikah')
                                                ->label('Status Pernikahan')
                                                ->options([
                                                    'Menikah' => '1. Menikah',
                                                    'Belum Menikah' => '2. Belum Menikah',
                                                    'Cerai' => '3. Cerai',
                                                ]),
                                            Forms\Components\Select::make('status_pegawai')
                                                ->label('Status Pegawai')
                                                ->options([
                                                    'KTD' => '1. KTD',
                                                    'Capeg' => '2. Capeg',
                                                    'Kontrak' => '3. Kontrak',
                                                    'Lepas' => '4. Pegawai Lepas',
                                                ]),
                                            Forms\Components\Select::make('Posisi')
                                                ->label('Posisi')
                                                ->options([
                                                    'Staf' => '1. Staf TU',
                                                    'Kebersihan' => '2. Kebersihan',
                                                    'Teknisi' => '3. Teknisi',
                                                    'Lepas' => '4. Pegawai Lepas',
                                                    'Imam' => '5. Imam Muazin',

                                                ]),
                                        ])
                                        ->columns(3),
                                ])
                                ->description('Enter your add details')
                                ->icon('heroicon-o-server-stack'),
                        ])
                            ->columns([
                                'xl' => 2,
                            ])
                            ->skippable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('index')->label('No')->rowIndex(),
                Tables\Columns\ImageColumn::make('foto')->label('Photo')
                    ->circular()->size(80)->getStateUsing(function ($record) {
                        return $record->foto ? url('storage/' . $record->foto) : url('storage/file-user/no-image.jpg');
                    })->tooltip(function ($record) {
                        return 'NIP : ' . $record->nip;
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Marbot')->icon('heroicon-m-user')->iconColor('primary')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('No. HP')->icon('heroicon-m-device-phone-mobile')->iconColor('primary'),
                Tables\Columns\TextColumn::make('email_user')->label('Email')
                    ->icon('heroicon-m-envelope')->iconColor('primary')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenkel')->label('Jenkel')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tlahir')->label('Tlahir')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tgl_lahir')->dateTime('d/m/Y')->label('Tgl. Lahir')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('alamat')->toggleable(isToggledHiddenByDefault: true)->lineClamp(1)->wrap(),
                Tables\Columns\TextColumn::make('status_nikah')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_pegawai')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('jenkel')
                    ->options([
                        'Laki-Laki' => 'Laki-Laki',
                        'Perempuan' => 'Perempuan',
                    ])->label('Filter by Jenis Kelamin'),
                SelectFilter::make('status_nikah')
                    ->options([
                        'Belum Menikah' => 'Belum Menikah',
                        'Cerai' => 'Cerai',
                        'Menikah' => 'Menikah',
                    ])->label('Filter by Status Nikah'),
                SelectFilter::make('status_pegawai')
                    ->options([
                        'KTD' => 'KTD',
                        'Capeg' => 'Capeg',
                        'Kontrak' => 'Kontrak',
                    ])->label('Filter by Status Pegawai'),

            ], layout: FiltersLayout::AboveContentCollapsible)->filtersFormColumns(3)

            ->actions([
                // Menambahkan tombol aksi di tabel
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver(),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger')->slideOver(),
                ]),

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
            RelationManagers\KeluargasRelationManager::class,
            RelationManagers\RiwayatkepegawaianRelationManager::class,
            RelationManagers\KesehatansRelationManager::class,
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Section 1 Data Personal
                Section::make('Informasi Pribadi')
                    ->description('Informasi pribadi mengenai anda')
                    ->icon('heroicon-s-user-plus')
                    ->collapsible()
                    ->headerActions([
                        Action::make('Export File')
                            ->icon('heroicon-m-printer')
                            ->action(function ($record) {
                                return redirect()->route('pdf.preview', ['id' => $record->id]);
                            })->openUrlInNewTab()
                            ->iconButton()->size(ActionSize::Large)->tooltip('Print PDF'),
                    ])
                    ->schema([
                        Grid::make(4) // Mengatur grid dengan 4 kolom
                            ->schema([
                                // Grid pertama berisi foto
                                Group::make([
                                    ImageEntry::make('foto')
                                        ->label('')
                                        ->square()
                                        ->size(100)
                                        ->getStateUsing(function ($record) {
                                            return $record->foto ? url('storage/' . $record->foto) : url('storage/file-user/no-image.jpg');
                                        })->tooltip(function ($record) {
                                            return 'NIP : ' . $record->nip;
                                        }),
                                ])->columns([
                                    'xl' => 1,
                                    'sm' => 2
                                ]),
                                // Grid ketiga berisi Nama Lengkap
                                Group::make([
                                    TextEntry::make('user.name')
                                        ->label('Nama Lengkap')
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-m-user-circle'),
                                ])->columns(1),
                                // Grid kedua berisi NIP
                                Group::make([
                                    TextEntry::make('nip')
                                        ->label('NIP')
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-m-identification'),
                                ])->columns(1),
                                // Grid kedua berisi Phone
                                Group::make([
                                    TextEntry::make('phone')
                                        ->label('No. HP')
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->icon('heroicon-m-phone'),
                                ])->columns(1),
                            ]),
                    ]),

                // Section 2 Add Information 
                Section::make('Informasi Tambahan')
                    ->description('Tambahan informasi mengenai anda')
                    ->icon('heroicon-s-clipboard-document-list')
                    ->collapsed()
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Group::make([

                                    TextEntry::make('tlahir')
                                        ->label('Tempat Lahir')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-map-pin'),
                                    TextEntry::make('tgl_lahir')->dateTime('d/m/Y')
                                        ->label('Tgl. Lahir')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-calendar'),
                                    TextEntry::make('jenkel')
                                        ->label('Jenis Kelamin')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-user'),
                                    TextEntry::make('goldar')
                                        ->label('Golongan Darah')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-heart'),
                                    TextEntry::make('status_nikah')
                                        ->label('Status Pernikahan')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-heart'),
                                    TextEntry::make('status_pegawai')
                                        ->label('Status Kepegawaian')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-briefcase'),
                                ])->columns(3),
                                Group::make([
                                    TextEntry::make('alamat')
                                        ->label('Alamat Lengkap')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextEntry\TextEntrySize::Large)
                                        ->icon('heroicon-m-map'),
                                ])->columnSpanFull(),
                            ]),
                    ]),

                // Section Data Keluarga
                Section::make('Informasi Keluarga')
                    ->description('Informasi mengenai keluarga')
                    ->icon('heroicon-s-user-group')
                    ->collapsed()
                    ->schema([
                        RepeatableEntry::make('keluargas')->label('')
                            ->schema([
                                Grid::make(6)
                                    ->schema([
                                        ImageEntry::make('foto_keluarga')
                                            ->label('')
                                            ->circular()
                                            ->size(80)
                                            ->getStateUsing(function ($record) {
                                                return $record->foto ? url('storage/' . $record->foto) : url('storage/file-user/no-image.jpg');
                                            })->tooltip(function ($record) {
                                                return $record->tipe_hubungan;
                                            }),

                                        TextEntry::make('nama')->label('Nama')->weight(FontWeight::Bold),
                                        TextEntry::make('no_kontak')->label('No. Kontak')->weight(FontWeight::Bold),
                                        TextEntry::make('tlahir')->label('Tmp. Lahir')->weight(FontWeight::Bold),
                                        TextEntry::make('tgl_lahir')->label('Tgl. Lahir')->dateTime('d/m/Y')->weight(FontWeight::Bold),
                                        TextEntry::make('keterangan')->label('Keterangan')->weight(FontWeight::Bold),
                                    ]),
                            ]),
                    ]),

                // Section Riwayat Kepegawaian
                Section::make('Riwayat Kepegawaian')
                    ->description('Informasi riwayat kepegawaian')
                    ->icon('heroicon-s-academic-cap')
                    ->collapsed()
                    ->schema([
                        RepeatableEntry::make('riwayatkepegawaians')->label('')
                            ->schema([
                                Grid::make(2) // Membuat grid dengan 2 kolom utama
                                    ->schema([
                                        // Kolom pertama dengan foto riwayat kepegawaian
                                        ImageEntry::make('foto_riwayatkepegawaian')
                                            ->label('')
                                            ->square()
                                            ->size(100),

                                        // Kolom kedua dengan informasi riwayat kepegawaian dibagi menjadi 3 kolom
                                        Grid::make(1) // Membagi kolom kedua menjadi grid dengan satu kolom utama
                                            ->schema([
                                                Grid::make(3) // Grid dalam kolom kedua dibagi menjadi 3 kolom
                                                    ->schema([
                                                        TextEntry::make('jenis_riwayat')->label('Jenis Riwayat')->weight(FontWeight::Bold),
                                                        TextEntry::make('nama')->label('Nama')->weight(FontWeight::Bold),
                                                        TextEntry::make('keterangan')->label('Keterangan')->weight(FontWeight::Bold),
                                                    ]),
                                            ]),
                                    ]),
                            ]),
                    ]),

                // Section Kesehatan
                Section::make('Kesehatan')
                    ->description('Informasi riwayat kesehatan')
                    ->icon('heroicon-s-beaker')
                    ->collapsed()
                    ->schema([
                        RepeatableEntry::make('kesehatans')->label('')
                            ->schema([
                                Grid::make(2) // Membuat grid dengan 2 kolom utama
                                    ->schema([
                                        // Kolom pertama dengan foto riwayat kesehatan
                                        ImageEntry::make('foto_kesehatan')
                                            ->label('')
                                            ->square()
                                            ->size(100),

                                        // Kolom kedua dengan informasi riwayat kesehatan dibagi menjadi 3 kolom
                                        Grid::make(1) // Membagi kolom kedua menjadi grid dengan satu kolom utama
                                            ->schema([
                                                Grid::make(3) // Grid dalam kolom kedua dibagi menjadi 3 kolom
                                                    ->schema([
                                                        TextEntry::make('jenis_riwayat')->label('Jenis Riwayat')->weight(FontWeight::Bold),
                                                        TextEntry::make('nama')->label('Nama')->weight(FontWeight::Bold),
                                                        TextEntry::make('keterangan')->label('Keterangan')->weight(FontWeight::Bold),
                                                    ]),
                                            ]),
                                    ]),
                            ]),
                    ]),
                \Filament\Infolists\Components\Section::make('Preview Data')
                    ->description('Lihat data lengkap pegawai dengan PDF')
                    ->collapsed()
                    ->schema([
                        PdfViewerEntry::make('file')
                            ->label('')
                            ->minHeight('100svh')
                            ->fileUrl(function ($record) {
                                return route('pdf.preview', ['id' => $record->id]);
                            })
                            ->columnSpanFull()
                            ->schema([])
                    ]),

            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        return parent::getEloquentQuery()->when(!$user->hasRole('super_admin'), function ($query) use ($user) {
            $query->where('email_user', $user->email);
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarbots::route('/'),
            'create' => Pages\CreateMarbot::route('/create'),
            'edit' => Pages\EditMarbot::route('/{record}/edit'),
        ];
    }
}
