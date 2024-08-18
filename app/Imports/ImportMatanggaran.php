<?php

namespace App\Imports;

use App\Models\KasKecilMatanggaran;
use Maatwebsite\Excel\Concerns\ToModel;

// Kelas ImportMatanggaran digunakan untuk mengimpor data ke model KasKecilMatanggaran dari file Excel
class ImportMatanggaran implements ToModel
{
    /**
     * Metode model digunakan untuk memetakan baris data dari file Excel ke model KasKecilMatanggaran.
     * 
     * @param array $row Data satu baris dari file Excel, setiap kolom direpresentasikan sebagai elemen array.
     *
     * @return \Illuminate\Database\Eloquent\Model|null Mengembalikan instance KasKecilMatanggaran yang baru dengan data dari baris Excel.
     */
    public function model(array $row)
    {
        // Membuat instance baru dari model KasKecilMatanggaran dengan mengisi kolom-kolomnya menggunakan data dari file Excel
        return new KasKecilMatanggaran([
            'kode_matanggaran' => $row[1],  // Mengisi kolom 'kode_matanggaran' dengan data dari kolom kedua Excel
            'kode_aas' => $row[2],          // Mengisi kolom 'kode_aas' dengan data dari kolom ketiga Excel
            'saldo' => $row[3],             // Mengisi kolom 'saldo' dengan data dari kolom keempat Excel
        ]);
    }
}
