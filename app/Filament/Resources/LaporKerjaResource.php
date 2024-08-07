<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\LaporKerja;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporKerjaResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\LaporKerjaResource\RelationManagers;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class LaporKerjaResource extends Resource
{
    protected static ?string $model = LaporKerja::class;

    protected static ?string $navigationGroup = 'Office Management';
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $modelLabel = 'Lapor Kerja';
    protected static ?string $navigationLabel = 'Lapor Kerja';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto_laporkerja')
                    ->image()->imageEditor()->openable()->multiple()->directory('file-laporkerja')->label('Gambar'),
                Forms\Components\TextInput::make('email_user')
                    ->label('Pelapor')->default($user->email)->readOnly(),
                Forms\Components\DatePicker::make('tgl')->label('Tgl. Lapor (Default, wajib lapor setiap hari)')
                    ->default(now())->readOnly()->required(),
                Forms\Components\TextInput::make('judul')
                    ->required()->maxLength(255),
                Forms\Components\Textarea::make('isi')
                    ->required()->maxLength(255),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->label('No')->rowIndex(),
                Tables\Columns\TextColumn::make('tgl')->dateTime('d/m/Y')->label('Tgl')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('foto_laporkerja')->label('Foto')
                    ->stacked()->size(40)->circular()->limit(3)->limitedRemainingText(),
                Tables\Columns\TextColumn::make('user.name')->label('Pelapor')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('judul')->label('Laporan')->sortable()->searchable()
                    ->description(fn (LaporKerja $record): string => $record->isi),
            ])
            ->filters([
                DateRangeFilter::make('tgl')->label('Filter by Range Tanggal'),
                Tables\Filters\SelectFilter::make('user.name')->label('Filter by Nama Marbot')
                    ->relationship('user', 'name'),
            ], layout: FiltersLayout::AboveContentCollapsible)->filtersFormColumns(2)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('info')->slideOver(),
                    Tables\Actions\EditAction::make()->color('primary')->slideOver(),
                    Tables\Actions\DeleteAction::make()->color('danger')->slideOver(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->color('info'),
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

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        return parent::getEloquentQuery()->when(!$user->hasRole('super_admin'), function ($query) use ($user) {
            $query->where('email_user', $user->email);
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporKerjas::route('/'),
            'create' => Pages\CreateLaporKerja::route('/create'),
            // 'edit' => Pages\EditLaporKerja::route('/{record}/edit'),
        ];
    }
}
