<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKecilMatanggaran extends Model
{
    use HasFactory;

    public function aas()
    {
        return $this->belongsTo(KasKecilAas::class, 'kode_aas', 'kode_aas');
    }

    public function getKodesMatanggaranAttribute()
    {
        return $this->kode_matanggaran . ' - ' . $this->aas->nama_aas;
    }

    public function transaksis()
    {
        return $this->hasMany(KasKecilTransaksi::class, 'kode_matanggaran', 'kode_matanggaran');
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }
}
