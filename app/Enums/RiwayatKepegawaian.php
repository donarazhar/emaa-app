<?php

namespace App\Enums;

enum RiwayatKepegawaian: string
{
    case BAHASA = 'Penguasaan Bahasa';
    case SEKOLAH = 'Riwayat Sekolah';
    case JABATAN = 'Riwayat Jabatan';
    case PENUGASAN = 'Riwayat Penugasan';
    case PELANGGARAN = 'Riwayat Pelanggaran';
    case PENGHARGAAN = 'Riwayat Penghargaan';

    public static function getValues(): array
    {
        return array_column(RiwayatKepegawaian::cases(), 'value');
    }
    public static function getKeyValues(): array
    {
        return array_column(RiwayatKepegawaian::cases(), 'value', 'value');
    }
}
