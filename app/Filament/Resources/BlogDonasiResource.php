<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogDonasiResource\Pages;
use App\Filament\Resources\BlogDonasiResource\RelationManagers;
use App\Models\BlogDonasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogDonasiResource extends Resource
{
    protected static ?string $model = BlogDonasi::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-banknotes';
    protected static ?string $modelLabel = 'Link Donasi';
    protected static ?string $navigationLabel = 'Link Donasi';
    protected static ?int $navigationSort = 5;

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
                Forms\Components\TextInput::make('nama')->label('Nama Program')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('link')->url()->prefix('url')
                    ->default(null),
                Forms\Components\FileUpload::make('thumbnail')->label('Upload file')
                    ->directory('file-donasi')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')->label('Link URL')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')->label('File Image')
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
            'index' => Pages\ListBlogDonasis::route('/'),
            'create' => Pages\CreateBlogDonasi::route('/create'),
            'edit' => Pages\EditBlogDonasi::route('/{record}/edit'),
        ];
    }
}
