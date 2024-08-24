<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogProfileMasjidResource\Pages;
use App\Filament\Resources\BlogProfileMasjidResource\RelationManagers;
use App\Models\BlogProfileMasjid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogProfileMasjidResource extends Resource
{
    protected static ?string $model = BlogProfileMasjid::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-server-stack';
    protected static ?string $modelLabel = 'Profile Masjid';
    protected static ?string $navigationLabel = 'Profile Masjid';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('thumbnail')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBlogProfileMasjids::route('/'),
            'create' => Pages\CreateBlogProfileMasjid::route('/create'),
            'edit' => Pages\EditBlogProfileMasjid::route('/{record}/edit'),
        ];
    }
}
