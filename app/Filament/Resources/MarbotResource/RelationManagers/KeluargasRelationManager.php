<?php

namespace App\Filament\Resources\MarbotResource\RelationManagers;

use App\Enums\TipeHubungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KeluargasRelationManager extends RelationManager
{
    protected static string $relationship = 'keluargas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama'),
                Forms\Components\TextInput::make('no_kontak'),
                Forms\Components\Select::make('tipe_hubungan')->options(TipeHubungan::getKeyValues()),

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
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('no_kontak'),
                Tables\Columns\TextColumn::make('tipe_hubungan'),
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
