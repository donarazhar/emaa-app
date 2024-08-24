<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogGiatMasjidResource\Pages;
use App\Filament\Resources\BlogGiatMasjidResource\RelationManagers;
use App\Models\BlogGiatMasjid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogGiatMasjidResource extends Resource
{
    protected static ?string $model = BlogGiatMasjid::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-rectangle-group';
    protected static ?string $modelLabel = 'Giat Masjid';
    protected static ?string $navigationLabel = 'Giat Masjid';
    protected static ?int $navigationSort = 3;

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
                Forms\Components\Textarea::make('isi')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('tanggal_jam'),
                Forms\Components\TextInput::make('blog_giat_masjid_kategori_id')
                    ->numeric()
                    ->default(null),
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
                Tables\Columns\TextColumn::make('tanggal_jam')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('blog_giat_masjid_kategori_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListBlogGiatMasjids::route('/'),
            'create' => Pages\CreateBlogGiatMasjid::route('/create'),
            'edit' => Pages\EditBlogGiatMasjid::route('/{record}/edit'),
        ];
    }
}
