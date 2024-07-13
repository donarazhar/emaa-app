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

    public function aas()
    {
        return $this->belongsTo(KasKecilAas::class, 'aas_id', 'id');
    }

    public function transaksis()
    {
        return $this->hasMany(KasKecilTransaksi::class, 'matanggaran_id', 'id');
    }
}
