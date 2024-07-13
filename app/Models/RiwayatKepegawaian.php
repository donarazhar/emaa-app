<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKepegawaian extends Model
{
    use HasFactory;

    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'riwayat_kepegawaian_marbot');
    }
}
