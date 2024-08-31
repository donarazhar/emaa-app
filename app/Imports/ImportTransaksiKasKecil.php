<?php

namespace App\Imports;

use App\Models\KasKecilTransaksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

// Kelas ImportTransaksiKasKecil digunakan untuk mengimpor data ke model KasKecilTransaksi dari file Excel
class ImportTransaksiKasKecil implements ToModel
{
    /**
     * Metode model digunakan untuk memetakan baris data dari file Excel ke model KasKecilTransaksi.
     * 
     * @param array $row Data satu baris dari file Excel, setiap kolom direpresentasikan sebagai elemen array.
     *
     * @return \Illuminate\Database\Eloquent\Model|null Mengembalikan instance KasKecilTransaksi yang baru dengan data dari baris Excel.
     */
    public function model(array $row)
    {
        // Membuat instance baru dari model KasKecilTransaksi dengan mengisi kolom-kolomnya menggunakan data dari file Excel
        return new KasKecilTransaksi([
            'perincian' => $row[1],
            'pengisian_id' => $row[2],
            'jumlah' => intval($row[3]),
            'kategori' => $row[4],
            'tgl_transaksi' => Carbon::parse($row[5])->format('Y-m-d'),
            'kode_matanggaran' => $row[6],
            'foto_kaskecil' => $row[7] ?? null,
        ]);
    }
}
