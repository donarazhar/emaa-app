<?php

namespace App\Enums;

enum TipeHubungan: string
{
    case AYAH = 'Ayah';
    case IBU = 'Ibu';
    case ISTRI = 'Istri';
    case SUAMI = 'Suami';
    case ANAK = 'Anak Kandung';
    case ANAKANGKAT = 'Anak Angkat';
    case SAUDARA = 'Saudara Kandung';

    public static function getValues(): array
    {
        return array_column(TipeHubungan::cases(), 'value');
    }
    public static function getKeyValues(): array
    {
        return array_column(TipeHubungan::cases(), 'value', 'value');
    }
}
