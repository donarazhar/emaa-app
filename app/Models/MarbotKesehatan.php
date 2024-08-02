<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarbotKesehatan extends Model
{
    use HasFactory;

    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'marbot_has_kesehatans', 'marbot_kesehatan_id', 'marbot_id');
    }
}
