<?php

namespace App\Enums;

enum TipeHubungan: string
{
    case AYAH = 'Ayah';
    case IBU = 'Ibu';
    case KAKAK = 'Kakak';
    case ANAK = 'Anak';

    public static function getValues(): array
    {
        return array_column(TipeHubungan::cases(), 'value');
    }
    public static function getKeyValues(): array
    {
        return array_column(TipeHubungan::cases(), 'value', 'value');
    }
}
