<?php

namespace App\Enums;

enum RiwayatKepegawaian: string
{
    case JABATAN = 'Riwayat Jabatan';
    case PENUGASAN = 'Riwayat Penugasan';
    case PELANGGARAN = 'Riwayat Pelanggaran';
    case BASAHA = 'Penguasaan Bahasa';
    case SEKOLAH = 'Riwayat Sekolah';

    public static function getValues(): array
    {
        return array_column(RiwayatKepegawaian::cases(), 'value');
    }
    public static function getKeyValues(): array
    {
        return array_column(RiwayatKepegawaian::cases(), 'value', 'value');
    }
}
