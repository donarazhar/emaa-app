<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisBagian extends Model
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

    public function setBagianInventarisAttribute($value)
    {
        $this->attributes['nama_bagian'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganBagianAttribute($value)
    {
        $this->attributes['keterangan_bagian'] = $this->setAttributesToProperCase($value);
    }
}
