<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusMurid extends Model
{
    use HasFactory;

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class);
    }

    public function absensis()
    {
        return $this->hasMany(KursusAbsensi::class);
    }

    public function penilaians()
    {
        return $this->hasMany(KursusPenilaian::class);
    }
}
