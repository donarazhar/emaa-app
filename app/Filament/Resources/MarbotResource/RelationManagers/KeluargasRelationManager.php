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
                Forms\Components\TextInput::make('nama'),
                Forms\Components\TextInput::make('no_kontak'),
                Forms\Components\Select::make('tipe_hubungan')->options(TipeHubungan::getKeyValues()),
                Forms\Components\Textarea::make('keterangan')->rows(3),

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
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('no_kontak')->label('HP')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tipe_hubungan')->label('Hubungan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipe_hubungan')
                    ->multiple()
                    ->options(TipeHubungan::getKeyValues())
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
