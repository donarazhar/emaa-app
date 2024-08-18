<?php

namespace App\Imports;

use App\Models\KasKecilAas;
use Maatwebsite\Excel\Concerns\ToModel;
use Filament\Actions\Imports\ImportColumn;

// Kelas ImportAas digunakan untuk mengimpor data ke model KasKecilAas dari file Excel
class ImportAas implements ToModel
{
    /**
     * Metode model digunakan untuk memetakan baris data dari file Excel ke model KasKecilAas.
     * 
     * @param array $row Data satu baris dari file Excel, setiap kolom direpresentasikan sebagai elemen array.
     *
     * @return \Illuminate\Database\Eloquent\Model|null Mengembalikan instance KasKecilAas yang baru dengan data dari baris Excel.
     */
    public function model(array $row)
    {
        // Membuat instance baru dari model KasKecilAas dengan mengisi kolom-kolomnya menggunakan data dari file Excel
        return new KasKecilAas([
            'kode_aas' => $row[1],   // Mengisi kolom 'kode_aas' dengan data dari kolom kedua Excel
            'nama_aas' => $row[2],   // Mengisi kolom 'nama_aas' dengan data dari kolom ketiga Excel
            'kategori' => $row[3],   // Mengisi kolom 'kategori' dengan data dari kolom keempat Excel
            'status' => $row[4],     // Mengisi kolom 'status' dengan data dari kolom kelima Excel
        ]);
    }
}
