<?php

namespace App\Filament\Resources\MarbotResource\Widgets;

use App\Models\Marbot;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MarbotTable extends BaseWidget
{
    protected static ?string $heading = 'Datatable Marbot';
    public function table(Table $table): Table
    {
        return $table
            ->query(Marbot::query())
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Marbot')->searchable(),
                Tables\Columns\TextColumn::make('jenkel')->label('Jenkel'),
                Tables\Columns\TextColumn::make('tlahir')->label('Tlahir'),
                Tables\Columns\TextColumn::make('tgl_lahir')->dateTime('d/m/Y')->label('Tgl. Lahir'),
                Tables\Columns\TextColumn::make('status_nikah'),
                Tables\Columns\TextColumn::make('status_pegawai'),
            ]);
    }
}
