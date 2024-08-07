<?php

namespace App\Filament\Resources\LayananTransaksiKonsultasiResource\Pages;

use App\Filament\Resources\LayananTransaksiKonsultasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLayananTransaksiKonsultasi extends CreateRecord
{
    protected static string $resource = LayananTransaksiKonsultasiResource::class;

    protected function getRedirectUrl(): string
    {
        // Mengubah redirect ketika sudah menyimpan
        return route('filament.admin.resources.layanan-transaksi-konsultasis.index');
    }
}
