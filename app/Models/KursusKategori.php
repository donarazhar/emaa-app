<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusKategori extends Model
{
    use HasFactory;

    public function guru()
    {
        return $this->belongsTo(KursusGuru::class);
    }

    public function jadwals()
    {
        return $this->hasMany(KursusJadwal::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class);
    }

    public function penilaians()
    {
        return $this->hasMany(KursusPenilaian::class);
    }
}
