<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BlogArticle;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogArticleResource\Pages;
use App\Filament\Resources\BlogArticleResource\RelationManagers;

class BlogArticleResource extends Resource
{
    protected static ?string $model = BlogArticle::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-newspaper';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $navigationLabel = 'Artikel';
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
                Forms\Components\DateTimePicker::make('tanggal_jam')->label('Tanggal Jam'),
                Forms\Components\Select::make('blog_article_kategori_id')->label('Kategori')
                    ->relationship('kategori', 'nama')
                    ->default(null),
                Forms\Components\FileUpload::make('thumbnail')->label('Upload file')
                    ->directory('file-artikel')
                    ->default(null),
                Forms\Components\TextInput::make('judul')->label('Judul Artikel')
                    ->maxLength(255)
                    ->default(null),
                RichEditor::make('isi')->label('Isi Artikel'),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No'),
                Tables\Columns\TextColumn::make('tanggal_jam')->label('Tgl. Dibuat')->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')->label('Judul Artikel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama')->label('Kategori')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail')->label('File Image')
                    ->size(40)->getStateUsing(function ($record) {
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
            'index' => Pages\ListBlogArticles::route('/'),
            // 'create' => Pages\CreateBlogArticle::route('/create'),
            // 'edit' => Pages\EditBlogArticle::route('/{record}/edit'),
        ];
    }
}
