<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;

class PrintBulkAction extends BulkAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Print')
            ->icon('heroicon-o-printer')
            ->action(fn(Collection $records) => $this->printRecords($records));
    }

    protected function printRecords(Collection $records)
    {
        // Logika pencetakan di sini
        return response()->view('kaskecil.cetak-laporankas', ['records' => $records])->header('Content-Type', 'application/pdf');
    }
}
