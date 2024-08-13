<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisMerk extends Model
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

    public function setNamaMerkAttribute($value)
    {
        $this->attributes['nama_merk'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganMerkAttribute($value)
    {
        $this->attributes['keterangan_merk'] = $this->setAttributesToProperCase($value);
    }
}
