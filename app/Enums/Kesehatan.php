<?php

namespace App\Enums;

enum Kesehatan: string
{
  
    case PENYAKIT = 'Penyakit Bawaan';
    case ALERGI = 'Alergi Obat & Semacamnya';
    case OPERASI = 'Riwayat Operasi';
    case OBAT    = 'Ketergantungan Obat';
    case CATATANMEDIS    = 'Catatan Medis Lainnya';

    public static function getValues(): array
    {
        return array_column(Kesehatan::cases(), 'value');
    }
    public static function getKeyValues(): array
    {
        return array_column(Kesehatan::cases(), 'value', 'value');
    }
}
