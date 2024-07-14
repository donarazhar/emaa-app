<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusPendaftaran extends Model
{
    use HasFactory;

    public function murid()
    {
        return $this->belongsTo(KursusMurid::class);
    }

    public function kursuskategoris()
    {
        return $this->belongsTo(KursusKategori::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(KursusPembayaran::class);
    }
}
