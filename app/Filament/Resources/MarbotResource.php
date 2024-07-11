<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarbotResource\Pages;
use App\Filament\Resources\MarbotResource\RelationManagers;
use App\Models\Marbot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarbotResource extends Resource
{
    protected static ?string $model = Marbot::class;

    protected static ?string $navigationGroup = 'Marbot';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Marbot';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama'),
                Forms\Components\TextInput::make('nip'),
                Forms\Components\TextInput::make('tlahir'),
                Forms\Components\DatePicker::make('tgl_lahir'),
                Forms\Components\Select::make('goldar')->options([
                    'O' => 'O',
                    'A' => 'A',
                    'AB' => 'AB',
                    'B' => 'B',
                ]),
                Forms\Components\Select::make('jenkel')->options([
                    'Pria' => 'Pria',
                    'Wanita' => 'Wanita',
                ]),
                Forms\Components\Select::make('status_nikah')->options([
                    'Lajang' => 'Lajang',
                    'Menikah' => 'Menikah',
                ]),
                Forms\Components\Select::make('status_pegawai')->options([
                    'KTD' => 'KTD',
                    'Capeg' => 'Capeg',
                    'Honorer' => 'Honorer',
                ]),
                Forms\Components\TextInput::make('alamat'),
                Forms\Components\Select::make('id')->label('User Account')
                    ->relationship('user', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('nama')->label('Nama Marbot'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
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
}
