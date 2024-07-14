<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusAbsensi extends Model
{
    use HasFactory;

    public function murid()
    {
        return $this->belongsTo(KursusMurid::class);
    }

    public function jadwals()
    {
        return $this->belongsTo(KursusJadwal::class, 'kursus_jadwal_id');
    }
}
