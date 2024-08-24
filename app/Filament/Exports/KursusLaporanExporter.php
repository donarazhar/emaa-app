<?php

namespace App\Filament\Exports;

use App\Models\KursusPembayaran;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class KursusLaporanExporter extends Exporter
{
    protected static ?string $model = KursusPembayaran::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('tanggal')->label('Tgl.'),
            ExportColumn::make('pendaftaran.murid.nama')->label('Nama Murid'),
            ExportColumn::make('pendaftaran.jadwal.kategori.jenis_kursus')->label('Jenis Kursus'),
            ExportColumn::make('jumlah')->label('Jumlah'),
            ExportColumn::make('metode_pembayaran')->label('Metode Bayar'),
            ExportColumn::make('status')->label('Status'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your kursus laporan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
