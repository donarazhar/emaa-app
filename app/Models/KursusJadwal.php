<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusJadwal extends Model
{
    use HasFactory;

    public function kursuskategoris()
    {
        return $this->belongsTo(KursusKategori::class);
    }

    public function absensis()
    {
        return $this->hasMany(KursusAbsensi::class);
    }
}
