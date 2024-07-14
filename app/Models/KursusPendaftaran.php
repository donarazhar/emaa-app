<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusPendaftaran extends Model
{
    use HasFactory;

    public function murid()
    {
        return $this->belongsTo(KursusMurid::class, 'kursus_murid_id');
    }

    public function jadwals()
    {
        return $this->belongsTo(KursusJadwal::class, 'kursus_jadwal_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(KursusPembayaran::class);
    }
}
