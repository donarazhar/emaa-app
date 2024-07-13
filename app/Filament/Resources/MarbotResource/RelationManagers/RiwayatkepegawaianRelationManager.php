<?php

namespace App\Filament\Resources\MarbotResource\RelationManagers;

use App\Enums\RiwayatKepegawaian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RiwayatkepegawaianRelationManager extends RelationManager
{
    protected static string $relationship = 'riwayatkepegawaians';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipe_hubungan')
                    ->options(RiwayatKepegawaian::getKeyValues())->label('Jenis Riwayat')->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('keterangan')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->maxSize(1024)
                    ->directory('file-user')
                    ->label('Gambar'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('tipe_hubungan')->label('Jenis Riwayat')->sortable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Riwayat'),
                Tables\Columns\TextColumn::make('keterangan'),
                Tables\Columns\ImageColumn::make('foto')->width(100)->height(100)->label('File'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
