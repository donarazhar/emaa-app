<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisBagian extends Model
{
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisBagian dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaBagianAttribute($value)
    {
        $this->attributes['nama_bagian'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganBagianAttribute($value)
    {
        $this->attributes['keterangan_bagian'] = $this->setAttributesToProperCase($value);
    }
}
