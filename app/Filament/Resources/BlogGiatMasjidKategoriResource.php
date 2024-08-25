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
                Forms\Components\TextInput::make('nama')->label('Nama Kategori')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('deskripsi')->label('Deskripsi')
                    ->maxLength(255)
                    ->default(null),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver(),
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
            // 'create' => Pages\CreateBlogGiatMasjidKategori::route('/create'),
            // 'edit' => Pages\EditBlogGiatMasjidKategori::route('/{record}/edit'),
        ];
    }
}
