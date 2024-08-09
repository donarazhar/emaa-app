<?php

namespace App\Imports;

use App\Models\KasKecilAas;
use Maatwebsite\Excel\Concerns\ToModel;
use Filament\Actions\Imports\ImportColumn;

class ImportAas implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KasKecilAas([
            'kode_aas' => $row[1],
            'nama_aas' => $row[2],
            'kategori' => $row[3],
            'status' => $row[4],
        ]);
    }
}
