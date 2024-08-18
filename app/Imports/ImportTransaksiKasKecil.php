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
            'perincian' => $row[1],                            // Mengisi kolom 'perincian' dengan data dari kolom kedua Excel
            'pengisian_id' => $row[2],                         // Mengisi kolom 'pengisian_id' dengan data dari kolom ketiga Excel
            'jumlah' => intval($row[3]),                       // Mengisi kolom 'jumlah' dengan data dari kolom keempat Excel, dan memastikan tipe data integer
            'kategori' => $row[4],                             // Mengisi kolom 'kategori' dengan data dari kolom kelima Excel
            'tgl_transaksi' => Carbon::parse($row[5])->format('Y-m-d'), // Mengisi kolom 'tgl_transaksi' dengan data dari kolom keenam Excel, format tanggal diubah menjadi 'Y-m-d'
            'kode_matanggaran' => $row[6],                     // Mengisi kolom 'kode_matanggaran' dengan data dari kolom ketujuh Excel
            'foto_kaskecil' => $row[7] ?? null,                // Mengisi kolom 'foto_kaskecil' dengan data dari kolom kedelapan Excel, jika ada. Jika tidak ada, diisi dengan null.
        ]);
    }
}
