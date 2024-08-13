<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisSatuan extends Model
{
    use HasFactory;

    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaSatuanAttribute($value)
    {
        $this->attributes['nama_satuan'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganSatuanAttribute($value)
    {
        $this->attributes['keterangan_satuan'] = $this->setAttributesToProperCase($value);
    }
}
