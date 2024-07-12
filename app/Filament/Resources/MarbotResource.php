<?php

namespace App\Filament\Resources;

use App\Events\PromoteMarbot;
use Filament\Forms;
use Filament\Tables;
use App\Models\Marbot;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Filament\GlobalSearch\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\MarbotResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MarbotResource\RelationManagers;

class MarbotResource extends Resource
{
    protected static ?string $model = Marbot::class;

    protected static ?string $navigationGroup = 'Marbot';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Marbot';
    protected static ?string $navigationLabel = 'Marbot';
    // // Menampilkan search
    // protected static ?string $recordTitleAttribute = 'nama';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // Section 1
                Forms\Components\Section::make('Personal Information')
                    ->description('Masukkan semua data pribadi')
                    ->collapsible()
                    ->schema([

                        // Wizard Component - Membuat Tabs Menu
                        Forms\Components\Wizard::make([
                            Forms\Components\Wizard\Step::make('First Information')
                                ->schema([
                                    Forms\Components\TextInput::make('nama'),
                                    Forms\Components\TextInput::make('nip'),
                                    Forms\Components\Select::make('jenkel')->options([
                                        'Laki-Laki' => 'Laki-Laki',
                                        'Perempuan' => 'Perempuan',
                                    ]),
                                    Forms\Components\TextInput::make('tlahir'),
                                    Forms\Components\DatePicker::make('tgl_lahir'), Forms\Components\Select::make('goldar')->options([
                                        'O' => 'O',
                                        'A' => 'A',
                                        'AB' => 'AB',
                                        'B' => 'B',
                                    ]),
                                ])
                                ->description('Enter your details')
                                ->icon('heroicon-o-users'),
                            Forms\Components\Wizard\Step::make('Twice Information')
                                ->schema([
                                    Forms\Components\Select::make('status_nikah')->options([
                                        'Belum Menikah' => 'Belum Menikah',
                                        'Cerai' => 'Cerai',
                                        'Menikah' => 'Menikah',
                                    ]),
                                    Forms\Components\Select::make('status_pegawai')->options([
                                        'KTD' => 'KTD',
                                        'Capeg' => 'Capeg',
                                        'Kontrak' => 'Kontrak',
                                    ]),
                                    Forms\Components\TextInput::make('alamat'),
                                ])
                                ->description('Enter your add details')
                                ->icon('heroicon-o-home'),
                            Forms\Components\Wizard\Step::make('Third Information')
                                ->schema([
                                    Forms\Components\Select::make('standard_id')->label('Tahun Masuk')
                                        ->relationship('standard', 'name'),

                                    Forms\Components\Select::make('user_id')->label('User Account')
                                        ->relationship('user', 'name'),
                                ])
                                ->description('Enter your school')
                                ->icon('heroicon-o-academic-cap'),

                        ])
                            ->columnSpanFull()
                            ->skippable(),

                    ]),

                // Section 2
                Forms\Components\Section::make('Riwayat Kesehatan')
                    ->description('Masukkan semua riwayat kesehatan')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\Repeater::make('kesehatan')->label('Riwayat Kesehatan')
                            ->schema([

                                Forms\Components\Select::make('name')->options(config('mm_config.kesehatan'))
                                    ->required(),
                                Forms\Components\TextInput::make('value')->required()->maxLength(255),
                            ])
                            ->columns([
                                'xl' => 2,
                            ])
                    ])

                // Akhir schema
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama')->label('Nama Marbot'),
                Tables\Columns\TextColumn::make('standard.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Menambahkan tombol aksi di tabel
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Promote')
                        ->action(function (Marbot $record) {
                            $record->standard_id = $record->standard_id + 1;
                            $record->save();
                        })->color('success')->requiresConfirmation(),
                    Tables\Actions\Action::make('Demote')
                        ->action(function (Marbot $record) {
                            if ($record->standard_id > 1) {
                                $record->standard_id = $record->standard_id - 1;
                                $record->save();
                            }
                        })->color('danger')->requiresConfirmation(),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    // Menambahkan bulk action
                    Tables\Actions\BulkAction::make('Promote all')
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                // //    event 1
                                // $record->standard_id = $record->standard_id + 1;
                                // $record->save();

                                // event 2
                                event(new PromoteMarbot($record));
                            });
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [

            // Menambahkan data keluarga
            RelationManagers\KeluargasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarbots::route('/'),
            'create' => Pages\CreateMarbot::route('/create'),
            'edit' => Pages\EditMarbot::route('/{record}/edit'),
        ];
    }


    // // Menampilkan search global
    // public static function getGlobalSearchResultActions(Model $record): array
    // {
    //     return [
    //         Action::make('Edit')
    //             ->iconButton()
    //             ->icon('heroicon-s-pencil')
    //             ->url(static::getUrl('edit', ['record' => $record]))
    //     ];
    // }
}
