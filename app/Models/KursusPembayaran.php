<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KursusPembayaran extends Model
{
    use HasFactory;

    public function pendaftaran()
    {
        return $this->belongsTo(KursusPendaftaran::class, 'kursus_pendaftaran_id');
    }
}
