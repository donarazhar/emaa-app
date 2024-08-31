<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\SuratTransaksi;
use Maatwebsite\Excel\Concerns\ToModel;

// Kelas ImportPersuratans digunakan untuk mengimpor data ke model SuratTransaksi dari file Excel
class ImportPersuratans implements ToModel
{
    /**
     * Metode model digunakan untuk memetakan baris data dari file Excel ke model SuratTransaksi.
     * 
     * @param array $row Data satu baris dari file Excel, setiap kolom direpresentasikan sebagai elemen array.
     *
     * @return \Illuminate\Database\Eloquent\Model|null Mengembalikan instance SuratTransaksi yang baru dengan data dari baris Excel.
     */
    public function model(array $row)
    {
        // Membuat instance baru dari model SuratTransaksi dengan mengisi kolom-kolomnya menggunakan data dari file Excel
        return new SuratTransaksi([
            'no_transaksi_surat' => $row[1],
            'tgl_transaksi_surat' => Carbon::parse($row[2])->format('Y-m-d'),
            'perihal_transaksi_surat' => $row[3],
            'surat_dari_transaksi_surat' => $row[4],
            'disposisi_transaksi_surat' => $row[5],
            'status_transaksi_surat' => $row[6],
            'kategori_surat_id' => $row[7],
            'asal_surat_id' => $row[8],
        ]);
    }
}
