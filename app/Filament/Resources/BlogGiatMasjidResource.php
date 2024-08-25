<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogGiatMasjidResource\Pages;
use App\Filament\Resources\BlogGiatMasjidResource\RelationManagers;
use App\Models\BlogGiatMasjid;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
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
                Forms\Components\DateTimePicker::make('tanggal_jam'),
                Forms\Components\Select::make('blog_giat_masjid_kategori_id')->label('Kategori')
                    ->relationship('kategori', 'nama')
                    ->default(null),
                Forms\Components\TextInput::make('judul')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('thumbnail')->label('Upload file')
                    ->directory('file-giatmasjid')
                    ->default(null),
                RichEditor::make('isi'),

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
            'index' => Pages\ListBlogGiatMasjids::route('/'),
            // 'create' => Pages\CreateBlogGiatMasjid::route('/create'),
            // 'edit' => Pages\EditBlogGiatMasjid::route('/{record}/edit'),
        ];
    }
}
