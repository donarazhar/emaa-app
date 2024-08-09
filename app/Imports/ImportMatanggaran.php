<?php

namespace App\Imports;

use App\Models\KasKecilMatanggaran;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMatanggaran implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KasKecilMatanggaran([
            'kode_matanggaran' => $row[1],
            'kode_aas' => $row[2],
            'saldo' => $row[3],
        ]);
    }
}
