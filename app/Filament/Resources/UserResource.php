<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?int $navigationSort = 20;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'User';
    protected static ?string $navigationLabel = 'User';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->maxSize(1024)
                    ->directory('file-user')
                    ->label('Gambar'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone number')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(static function ($state) {
                        // Return the state only if it is filled, otherwise null
                        return filled($state) ? Hash::make($state) : null;
                    })
                    ->dehydrated(fn ($state) => filled($state)) // Dehydrate only if the state is filled
                    ->label('Password'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\ImageColumn::make('foto')->label('Gambar')->circular(),
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('phone')->label('No. HP'),
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure that the password is not hydrated into the form, so it is not exposed
        unset($data['password']);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (array_key_exists('password', $data) && is_null($data['password'])) {
            unset($data['password']); // Keep the existing password if no new password is provided
        }
        $record->update($data);
        return $record;
    }
}