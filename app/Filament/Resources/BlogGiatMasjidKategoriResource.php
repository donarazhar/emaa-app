<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogGiatMasjidKategoriResource\Pages;
use App\Filament\Resources\BlogGiatMasjidKategoriResource\RelationManagers;
use App\Models\BlogGiatMasjidKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogGiatMasjidKategoriResource extends Resource
{
    protected static ?string $model = BlogGiatMasjidKategori::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $modelLabel = 'Kategori Giat Masjid';
    protected static ?string $navigationLabel = 'Kategori Giat Masjid';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationParentItem = 'Giat Masjid';
    protected static ?int $navigationSort = 1;


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
                Forms\Components\TextInput::make('nama')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('deskripsi')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
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
            'index' => Pages\ListBlogGiatMasjidKategoris::route('/'),
            'create' => Pages\CreateBlogGiatMasjidKategori::route('/create'),
            'edit' => Pages\EditBlogGiatMasjidKategori::route('/{record}/edit'),
        ];
    }
}
