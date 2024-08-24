<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogKonsultasiResource\Pages;
use App\Filament\Resources\BlogKonsultasiResource\RelationManagers;
use App\Models\BlogKonsultasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogKonsultasiResource extends Resource
{
    protected static ?string $model = BlogKonsultasi::class;

    protected static ?string $navigationGroup = 'Blog Management';
    protected static ?string $navigationIcon = 'heroicon-m-identification';
    protected static ?string $modelLabel = 'Konsultasi';
    protected static ?string $navigationLabel = 'Konsultasi';
    protected static ?int $navigationSort = 4;

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
                Forms\Components\Textarea::make('isi')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('jawaban')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('tanggal_jam'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_jam')
                    ->dateTime()
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
            'index' => Pages\ListBlogKonsultasis::route('/'),
            'create' => Pages\CreateBlogKonsultasi::route('/create'),
            'edit' => Pages\EditBlogKonsultasi::route('/{record}/edit'),
        ];
    }
}
