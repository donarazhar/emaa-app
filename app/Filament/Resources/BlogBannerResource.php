<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogBannerResource\Pages;
use App\Filament\Resources\BlogBannerResource\RelationManagers;
use App\Models\BlogBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogBannerResource extends Resource
{
    protected static ?string $model = BlogBanner::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-code-bracket-square';
    protected static ?string $modelLabel = 'Banner';
    protected static ?string $navigationLabel = 'Banner';
    protected static ?int $navigationSort = -1;

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
                Forms\Components\TextInput::make('nama')->label('Nama Banner')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('thumbnail')->label('Upload file')
                    ->directory('file-banner')
                    ->default(null),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No'),
                Tables\Columns\TextColumn::make('created_at')->label('Tgl. Dibuat')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('nama')->label('Nama Banner')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')->label('File Image')
                    ->width(200)->height(100)->getStateUsing(function ($record) {
                        return $record->thumbnail ? url('storage/' . $record->thumbnail) : url('storage/file-user/no-image.jpg');
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
            'index' => Pages\ListBlogBanners::route('/'),
            // 'create' => Pages\CreateBlogBanner::route('/create'),
            // 'edit' => Pages\EditBlogBanner::route('/{record}/edit'),
        ];
    }
}
