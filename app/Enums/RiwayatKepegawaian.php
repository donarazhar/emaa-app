<?php

namespace App\Enums;

// Deklarasi enum bernama RiwayatKepegawaian yang mewakili berbagai jenis riwayat dalam kepegawaian
enum RiwayatKepegawaian: string
{
        // Setiap case merepresentasikan jenis riwayat kepegawaian dengan nilai string tertentu
    case BAHASA = '1-Penguasaan Bahasa';       // Case untuk penguasaan bahasa
    case SEKOLAH = '2-Riwayat Sekolah';        // Case untuk riwayat sekolah
    case JABATAN = '3-Riwayat Jabatan';        // Case untuk riwayat jabatan
    case PENUGASAN = '4-Riwayat Penugasan';    // Case untuk riwayat penugasan
    case PELANGGARAN = '5-Riwayat Pelanggaran'; // Case untuk riwayat pelanggaran
    case PENGHARGAAN = '6-Riwayat Penghargaan'; // Case untuk riwayat penghargaan

    // Metode statis untuk mendapatkan array dari semua nilai (value) dari enum RiwayatKepegawaian
    public static function getValues(): array
    {
        // Menggunakan array_column untuk mengambil kolom 'value' dari setiap case enum
        return array_column(RiwayatKepegawaian::cases(), 'value');
    }

    // Metode statis untuk mendapatkan array asosiatif dengan key dan value yang sama dari enum RiwayatKepegawaian
    public static function getKeyValues(): array
    {
        // Menggunakan array_column untuk mengambil array dengan key dan value yang sama dari enum
        return array_column(RiwayatKepegawaian::cases(), 'value', 'value');
    }
}
