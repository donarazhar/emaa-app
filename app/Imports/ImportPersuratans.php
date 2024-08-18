<?php

namespace App\Imports;

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
            'no_transaksi_surat' => $row[1],           // Mengisi kolom 'no_transaksi_surat' dengan data dari kolom kedua Excel
            'tgl_transaksi_surat' => $row[2],          // Mengisi kolom 'tgl_transaksi_surat' dengan data dari kolom ketiga Excel
            'perihal_transaksi_surat' => $row[3],      // Mengisi kolom 'perihal_transaksi_surat' dengan data dari kolom keempat Excel
            'surat_dari_transaksi_surat' => $row[4],   // Mengisi kolom 'surat_dari_transaksi_surat' dengan data dari kolom kelima Excel
            'disposisi_transaksi_surat' => $row[5],    // Mengisi kolom 'disposisi_transaksi_surat' dengan data dari kolom keenam Excel
            'status_transaksi_surat' => $row[6],       // Mengisi kolom 'status_transaksi_surat' dengan data dari kolom ketujuh Excel
            'kategori_surat_id' => $row[7],            // Mengisi kolom 'kategori_surat_id' dengan data dari kolom kedelapan Excel
            'asal_surat_id' => $row[8],                // Mengisi kolom 'asal_surat_id' dengan data dari kolom kesembilan Excel
        ]);
    }
}
