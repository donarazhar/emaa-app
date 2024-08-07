<?php

namespace App\Filament\Resources\MarbotResource\RelationManagers;

use App\Enums\TipeHubungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class KeluargasRelationManager extends RelationManager
{
    protected static string $relationship = 'keluargas';

    protected static ?string $modelLabel = 'Hubungan Keluarga';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipe_hubungan')->label('Tipe Hubungan')->columnSpanFull()->options(TipeHubungan::getKeyValues()),
                Forms\Components\TextInput::make('nama'),
                Forms\Components\Select::make('jenkel')->label('Jenkel')->options([
                    'Laki-Laki' => 'Laki-Laki',
                    'Perempuan' => 'Perempuan',
                ])->required(),
                Forms\Components\TextInput::make('no_kontak'),
                Forms\Components\TextInput::make('tlahir')
                    ->label('Tmp. Lahir')->required(),
                Forms\Components\DatePicker::make('tgl_lahir')->label('Tgl. Lahir')
                    ->maxDate(now()->subYears(20))->required(),
                Forms\Components\FileUpload::make('foto_keluarga')->label('Foto')
                    ->image()->openable()->downloadable()->directory('file-keluarga'),
                Forms\Components\Textarea::make('keterangan')->rows(3)->columnSpanFull(),
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')

            ->columns([
                Tables\Columns\TextColumn::make('index')->label('No.')->rowIndex(),
                Tables\Columns\ImageColumn::make('foto_keluarga')->label('Photo')
                    ->circular()->size(50)->getStateUsing(function ($record) {
                        return $record->foto_keluarga ? url('storage/' . $record->foto_keluarga) : url('storage/file-user/no-image.jpg');
                    }),
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('tlahir')->label('Tlahir'),
                Tables\Columns\TextColumn::make('tgl_lahir')->dateTime('d/m/Y')->label('Tgl. Lahir'),
                Tables\Columns\TextColumn::make('no_kontak')->label('HP')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tipe_hubungan')->label('Hubungan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipe_hubungan')
                    ->multiple()
                    ->options(TipeHubungan::getKeyValues())
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Buat Data Keluarga'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->color('primary')->slideOver(),
                    Tables\Actions\DeleteAction::make()->color('danger')->slideOver(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
