<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarbotRiwayatKepegawaian extends Model
{
    use HasFactory;

    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'marbot_has_riwayat_kepegawaians', 'marbot_riwayat_kepegawaian_id', 'marbot_id');
    }
}
