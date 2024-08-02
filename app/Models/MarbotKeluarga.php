<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarbotKeluarga extends Model
{
    use HasFactory;
     
    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'marbot_has_keluargas', 'marbot_keluarga_id', 'marbot_id');
    }
}
