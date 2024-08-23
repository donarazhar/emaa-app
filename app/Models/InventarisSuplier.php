<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisSuplier extends Model
{
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisSuplier dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaSuplierAttribute($value)
    {
        $this->attributes['nama_suplier'] = $this->setAttributesToProperCase($value);
    }

    public function setAlamatSuplierAttribute($value)
    {
        $this->attributes['alamat_suplier'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganSuplierAttribute($value)
    {
        $this->attributes['keterangan_suplier'] = $this->setAttributesToProperCase($value);
    }
}
