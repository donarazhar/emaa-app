<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\BlogProfileMasjid;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogProfileMasjidResource\Pages;
use App\Filament\Resources\BlogProfileMasjidResource\RelationManagers;

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
                Forms\Components\TextInput::make('judul')->label('Judul Profile')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('thumbnail')->label('Thumbnail')
                    ->directory('file-profile')
                    ->default(null),
                RichEditor::make('isi')->label('Deskripsi Profile'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No'),
                Tables\Columns\TextColumn::make('judul')->label('Judul Profile')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')->label('Thumbnail')
                    ->width(200)->height(100)->getStateUsing(function ($record) {
                        return $record->thumbnail ? url('storage/' . $record->thumbnail) : url('storage/file-user/no-image-banner.jpg');
                    }),
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
            'index' => Pages\ListBlogProfileMasjids::route('/'),
            // 'create' => Pages\CreateBlogProfileMasjid::route('/create'),
            // 'edit' => Pages\EditBlogProfileMasjid::route('/{record}/edit'),
        ];
    }
}
