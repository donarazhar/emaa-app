<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKecilTransaksi extends Model
{
    use HasFactory;

    public function matanggaran()
    {
        return $this->belongsTo(KasKecilMatanggaran::class, 'matanggaran_id', 'id');
    }
}
