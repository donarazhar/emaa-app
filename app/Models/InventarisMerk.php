<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisMerk extends Model
{
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisMerk dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaMerkAttribute($value)
    {
        $this->attributes['nama_merk'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganMerkAttribute($value)
    {
        $this->attributes['keterangan_merk'] = $this->setAttributesToProperCase($value);
    }
}
