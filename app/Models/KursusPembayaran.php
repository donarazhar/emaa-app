<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusPembayaran extends Model
{
    use HasFactory;

    public function pendaftaran()
    {
        return $this->belongsTo(KursusPendaftaran::class, 'kursus_pendaftaran_id');
    }
}
