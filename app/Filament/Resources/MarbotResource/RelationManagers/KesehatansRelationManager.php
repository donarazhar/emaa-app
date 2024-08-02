<?php

namespace App\Filament\Resources\MarbotResource\RelationManagers;

use App\Enums\Kesehatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class KesehatansRelationManager extends RelationManager
{
    protected static string $relationship = 'kesehatans';

    protected static ?string $modelLabel = 'Riwayat Kesehatan';


    public function form(Form $form): Form
    {
        return $form
            ->schema([               
                Forms\Components\Select::make('jenis_riwayat')
                    ->options(Kesehatan::getKeyValues())->label('Riwayat Kesehatan')->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('keterangan')
                ->rows(3)
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto_kesehatan')
                    ->image()
                    ->maxSize(1024)
                    ->directory('file-kesehatan')
                    ->label('Lampiran'),
                    
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('jenis_riwayat')->label('Jenis Riwayat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Riwayat'),
                Tables\Columns\TextColumn::make('keterangan'),
                Tables\Columns\ImageColumn::make('foto_kesehatan')->label('File')
                ->square()
                ->size(50)
                ->getStateUsing(function ($record) {
                    return $record->foto_kesehatan ? url('storage/' . $record->foto_kesehatan) : url('storage/file-user/no-image.jpg');
                }), 
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_riwayat')
                ->multiple()
                ->options(Kesehatan::getKeyValues())
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
