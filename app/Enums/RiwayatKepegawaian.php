<?php

namespace App\Enums;

enum RiwayatKepegawaian: string
{
    case JABATAN = 'Jabatan';
    case PENUGASAN = 'Penugasan';
    case PELANGGARAN = 'Pelanggaran';

    public static function getValues(): array
    {
        return array_column(RiwayatKepegawaian::cases(), 'value');
    }
    public static function getKeyValues(): array
    {
        return array_column(RiwayatKepegawaian::cases(), 'value', 'value');
    }
}
