<?php

namespace App\Enums;

// Deklarasi enum bernama Kesehatan, yang mewakili status kesehatan tertentu
enum Kesehatan: string
{
        // Setiap case merepresentasikan jenis status kesehatan yang berbeda dengan nilai string tertentu
    case PENYAKIT = '1-Penyakit Bawaan';           // Case untuk penyakit bawaan
    case ALERGI = '2-Alergi Obat & Semacamnya';    // Case untuk alergi obat dan sejenisnya
    case OPERASI = '3-Riwayat Operasi';            // Case untuk riwayat operasi
    case OBAT = '4-Ketergantungan Obat';           // Case untuk ketergantungan obat
    case CATATANMEDIS = '5-Catatan Medis Lainnya'; // Case untuk catatan medis lainnya

    // Metode statis untuk mendapatkan array dari semua nilai (value) dari enum Kesehatan
    public static function getValues(): array
    {
        // Menggunakan array_column untuk mengambil kolom 'value' dari setiap case enum
        return array_column(Kesehatan::cases(), 'value');
    }

    // Metode statis untuk mendapatkan array asosiatif dengan key dan value yang sama dari enum Kesehatan
    public static function getKeyValues(): array
    {
        // Menggunakan array_column untuk mengambil array dengan key dan value yang sama dari enum
        return array_column(Kesehatan::cases(), 'value', 'value');
    }
}
