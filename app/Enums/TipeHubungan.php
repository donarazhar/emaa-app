<?php

namespace App\Enums;

// Deklarasi enum bernama TipeHubungan yang mewakili berbagai jenis hubungan keluarga
enum TipeHubungan: string
{
        // Setiap case merepresentasikan jenis hubungan dengan nilai string tertentu
    case AYAH = '1-Ayah';               // Case untuk hubungan ayah
    case IBU = '2-Ibu';                 // Case untuk hubungan ibu
    case ISTRI = '3-Istri';             // Case untuk hubungan istri
    case SUAMI = '4-Suami';             // Case untuk hubungan suami
    case ANAK = '5-Anak Kandung';       // Case untuk hubungan anak kandung
    case ANAKANGKAT = '6-Anak Angkat';  // Case untuk hubungan anak angkat
    case SAUDARA = '7-Saudara Kandung'; // Case untuk hubungan saudara kandung

    // Metode statis untuk mendapatkan array dari semua nilai (value) dari enum TipeHubungan
    public static function getValues(): array
    {
        // Menggunakan array_column untuk mengambil kolom 'value' dari setiap case enum
        return array_column(TipeHubungan::cases(), 'value');
    }

    // Metode statis untuk mendapatkan array asosiatif dengan key dan value yang sama dari enum TipeHubungan
    public static function getKeyValues(): array
    {
        // Menggunakan array_column untuk mengambil array dengan key dan value yang sama dari enum
        return array_column(TipeHubungan::cases(), 'value', 'value');
    }
}
