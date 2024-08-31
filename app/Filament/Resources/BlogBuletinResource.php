<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BlogBuletin;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogBuletinResource\Pages;
use App\Filament\Resources\BlogBuletinResource\RelationManagers;

class BlogBuletinResource extends Resource
{
    protected static ?string $model = BlogBuletin::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-newspaper';
    protected static ?string $modelLabel = 'Buletin Jumat';
    protected static ?string $navigationLabel = 'Buletin Jumat';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('tanggal_jam')->label('Tanggal Jam'),
                Forms\Components\FileUpload::make('thumbnail')->label('Upload file')
                    ->directory('file-buletin')
                    ->default(null),
                Forms\Components\TextInput::make('judul')->label('Judul Buletin')
                    ->maxLength(255)
                    ->default(null),
                RichEditor::make('isi')->label('Isi Buletin'),
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
                Tables\Columns\ImageColumn::make('thumbnail')->label('Thumbnail')
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
            'index' => Pages\ListBlogBuletins::route('/'),
            // 'create' => Pages\CreateBlogBuletin::route('/create'),
            // 'edit' => Pages\EditBlogBuletin::route('/{record}/edit'),
        ];
    }
}
