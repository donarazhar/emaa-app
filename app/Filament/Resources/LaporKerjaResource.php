<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporKerjaResource\Pages;
use App\Filament\Resources\LaporKerjaResource\RelationManagers;
use App\Models\LaporKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaporKerjaResource extends Resource
{
    protected static ?string $model = LaporKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $modelLabel = 'Lapor Kerja';
    protected static ?string $navigationLabel = 'Lapor Kerja';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->label('Nama Pelapor')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('tgl')->label('Tgl. Lapor')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextArea::make('isi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->multiple()
                    ->maxSize(1024)
                    ->directory('file-laporkerja')
                    ->label('Gambar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\ImageColumn::make('foto')->label('Gambar')->circular(),
                Tables\Columns\TextColumn::make('user.name')->label('Nama Pelapor'),
                Tables\Columns\TextColumn::make('tgl')->dateTime('d/m/Y')->label('Tgl. Lapor'),
                Tables\Columns\TextColumn::make('judul')->label('Judul'),
                Tables\Columns\TextColumn::make('isi')->label('Deskripsi Kerja'),
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
            'index' => Pages\ListLaporKerjas::route('/'),
            // 'create' => Pages\CreateLaporKerja::route('/create'),
            // 'edit' => Pages\EditLaporKerja::route('/{record}/edit'),
        ];
    }
}
