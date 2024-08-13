<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisKategori extends Model
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

    public function setKategoriInventarisAttribute($value)
    {
        $this->attributes['nama_kategori'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganKategoriAttribute($value)
    {
        $this->attributes['keterangan_kategori'] = $this->setAttributesToProperCase($value);
    }
}
