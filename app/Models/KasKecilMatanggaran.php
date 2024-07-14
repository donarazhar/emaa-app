<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKecilMatanggaran extends Model
{
    use HasFactory;

    public function aas()
    {
        return $this->belongsTo(KasKecilAas::class, 'aas_id');
    }

    public function transaksis()
    {
        return $this->hasMany(KasKecilTransaksi::class, 'matanggaran_id');
    }
}
