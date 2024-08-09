<?php

namespace App\Imports;

use App\Models\KasKecilTransaksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Filament\Actions\Imports\ImportColumn;

class ImportTransaksiKasKecil implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KasKecilTransaksi([
            'perincian' => $row[1],
            'pengisian_id' => $row[2],
            'jumlah' => intval($row[3]),
            'kategori' => $row[4],
            'tgl_transaksi' => \Carbon\Carbon::parse($row[5])->format('Y-m-d'),
            'kode_matanggaran' => $row[6],
            'foto_kaskecil' => $row[7] ?? null,
        ]);
    }
}
