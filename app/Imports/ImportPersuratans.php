<?php

namespace App\Imports;

use App\Models\SuratTransaksi;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPersuratans implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SuratTransaksi([
            'no_transaksi_surat' => $row[1],
            'tgl_transaksi_surat' => $row[2],
            'perihal_transaksi_surat' => $row[3],
            'surat_dari_transaksi_surat' => $row[4],
            'disposisi_transaksi_surat' => $row[5],
            'status_transaksi_surat' => $row[6],
            'kategori_surat_id' => $row[7],
            'asal_surat_id' => $row[8],
        ]);
    }
}
