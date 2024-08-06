<?php

namespace App\Filament\Resources\MarbotResource\RelationManagers;

use App\Enums\RiwayatKepegawaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RiwayatkepegawaianRelationManager extends RelationManager
{
    protected static string $relationship = 'riwayatkepegawaians';

    protected static ?string $modelLabel = 'Riwayat Kepegawaian';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jenis_riwayat')
                    ->options(RiwayatKepegawaian::getKeyValues())->label('Jenis Riwayat')->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()->maxLength(255),
                Forms\Components\Textarea::make('keterangan')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto_riwayatkepegawaian')
                    ->image()->maxSize(1024)->directory('file-riwayatkepegawaian')->label('Lampiran'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('jenis_riwayat')->label('Jenis Riwayat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Riwayat'),
                Tables\Columns\TextColumn::make('keterangan'),
                Tables\Columns\ImageColumn::make('foto_riwayatkepegawaian')->label('File')
                    ->square()->size(50)->getStateUsing(function ($record) {
                        return $record->foto_riwayatkepegawaian ? url('storage/' . $record->foto_riwayatkepegawaian) : url('storage/file-user/no-image.jpg');
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_riwayat')
                    ->multiple()->options(RiwayatKepegawaian::getKeyValues())
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
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
}
