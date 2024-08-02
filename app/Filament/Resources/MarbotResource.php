<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Marbot;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Wizard;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\Group;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\MarbotResource\Pages;
use App\Filament\Resources\MarbotResource\RelationManagers;

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
                            Forms\Components\Wizard\Step::make('First Information')
                                ->schema([
                                    Forms\Components\FileUpload::make('foto')->label('Foto Profile')
                                    ->image()->openable()->downloadable()->directory('file-marbot'),
                                    Forms\Components\Select::make('email_user')->label('Users Akun')
                                    ->relationship('user', 'name')->required(),    
                                    Forms\Components\TextInput::make('nip')->label('NIP')
                                    ->numeric()->maxLength(15)->required(),
                                    Forms\Components\TextInput::make('phone')->label('No. HP')
                                    ->numeric()->maxLength(15)->required(),
                                    Forms\Components\Select::make('jenkel')->label('Jenkel')->options([
                                        'Laki-Laki' => 'Laki-Laki',
                                        'Perempuan' => 'Perempuan',
                                    ])->required(),
                                    Forms\Components\TextInput::make('tlahir')
                                    ->label('Tmp. Lahir')->required()                             ,
                                    Forms\Components\DatePicker::make('tgl_lahir')->label('Tgl. Lahir')
                                    ->maxDate(now()->subYears(20)) 
                                    ->required(),
                                    Forms\Components\Select::make('goldar')->label('Goldar')->options([
                                        'O' => 'O',
                                        'A' => 'A',
                                        'AB' => 'AB',
                                        'B' => 'B',
                                    ])->required(),
                                ])
                                ->description('Enter your details')
                                ->icon('heroicon-o-users'),
                            Forms\Components\Wizard\Step::make('Twice Information')
                            ->schema([
                                    Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap')
                                    ->maxLength(255)->rows(7)->required()->columnSpanFull(),
                                    Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Select::make('status_nikah')
                                            ->label('Status Pernikahan')
                                            ->options([
                                                'Menikah' => '1. Menikah',
                                                'Belum Menikah' => '2. Belum Menikah',
                                                'Cerai' => '3. Cerai',
                                            ])
                                            ->required(),
                                        Forms\Components\Select::make('status_pegawai')
                                            ->label('Status Pegawai')
                                            ->options([
                                                'KTD' => '1. KTD',
                                                'Capeg' => '2. Capeg',
                                                'Kontrak' => '3. Kontrak',
                                            ])
                                            ->required(),
                                    ])
                                    ->columns(2),
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
                Tables\Columns\TextColumn::make('index')->label('No')
                ->rowIndex(),   
                Tables\Columns\ImageColumn::make('foto')->label('Photo')
                ->square()
                ->size(100)
                ->getStateUsing(function ($record) {
                    return $record->foto ? url('storage/' . $record->foto) : url('storage/file-user/no-image.jpg');
                }),            
                Tables\Columns\TextColumn::make('user.name')->label('Nama Marbot'),
                Tables\Columns\TextColumn::make('jenkel')->label('Jenkel'),
                Tables\Columns\TextColumn::make('tlahir')->label('Tlahir'),
                Tables\Columns\TextColumn::make('tgl_lahir')->dateTime('d/m/Y')->label('Tgl. Lahir'),
                Tables\Columns\TextColumn::make('status_nikah'),
                Tables\Columns\TextColumn::make('status_pegawai'),
                Tables\Columns\TextColumn::make('alamat')
                ->toggleable(isToggledHiddenByDefault: true),
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
                    Tables\Actions\ViewAction::make()->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
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
            ->collapsible()
            ->schema([
                Grid::make(4) // Mengatur grid dengan 4 kolom
                    ->schema([
                        // Grid pertama berisi foto
                        Group::make([
                            ImageEntry::make('foto')
                                ->label('')
                                ->square()
                                ->size(100),
                        ])->columns(1),
                        // Grid ketiga berisi Nama Lengkap
                        Group::make([
                            TextEntry::make('user.name')
                                ->label('Nama Lengkap')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::Bold)
                                ->icon('heroicon-o-user-circle'),
                        ])->columns(1),
                        // Grid kedua berisi NIP
                        Group::make([
                            TextEntry::make('nip')
                            ->label('NIP')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-identification'),
                            ])->columns(1),
                        // Grid kedua berisi Phone
                        Group::make([
                            TextEntry::make('phone')
                                ->label('No. HP')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::Bold)
                                ->icon('heroicon-o-phone'),
                        ])->columns(1),
                    ]),
            ]),

            // Section 2 Add Information 
            Section::make('Informasi Tambahan')
            ->description('Tambahan informasi mengenai anda')
            ->collapsible()
            ->schema([
                Grid::make(1) 
                    ->schema([
                        Group::make([
                            
                            TextEntry::make('tlahir')
                                ->label('Tempat Lahir')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-map-pin'),
                            TextEntry::make('tgl_lahir')
                                ->label('Tgl. Lahir')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-calendar'),
                            TextEntry::make('jenkel')
                                ->label('Jenis Kelamin')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-user'),
                            TextEntry::make('goldar')
                                ->label('Golongan Darah')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-heart'),
                            TextEntry::make('status_nikah')
                                ->label('Status Pernikahan')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-heart'),
                                TextEntry::make('status_pegawai')
                                ->label('Status Kepegawaian')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-briefcase'),
                        ])->columns(3),
                        Group::make([                            
                            TextEntry::make('alamat')
                                ->label('Alamat Lengkap')
                                ->weight(FontWeight::Bold)
                                ->size(TextEntry\TextEntrySize::Large)
                                ->icon('heroicon-o-map'),
                        ])->columnSpanFull(),
                    ]),
            ]),

            // Section Keluarga
            Section::make('Keluarga')
            ->description('Family data details')
            ->collapsible()
            ->schema([
                
            ]),


            // Section Riwayat Kepegawaian
            Section::make('Riwayat Kepegawaian')
                ->description('Enter your employment history details')
                ->collapsible()
                ->schema([
                    Grid::make(3) // Mengatur grid dengan 3 kolom
                        ->schema([
                            TextEntry::make('riwayatkepegawaian.nama')->label('Nama Riwayat'),
                        ]),
                ]),

            // Section Kesehatan
            Section::make('Kesehatan')
                ->description('Enter your health details')
                ->collapsible()
                ->schema([
                    Grid::make(3) // Mengatur grid dengan 3 kolom
                        ->schema([
                            TextEntry::make('kesehatans.nama')->label('Nama Kesehatan'),
                        ]),
                ]),
        ]);
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
