<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusGuru extends Model
{
    use HasFactory;

    public function kategoris()
    {
        return $this->hasMany(KursusKategori::class);
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $this->setAttributesToProperCase($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = $this->setAttributesToProperCase($value);
    }

    public function setBidangKeahlianAttribute($value)
    {
        $this->attributes['bidang_keahlian'] = $this->setAttributesToProperCase($value);
    }
}
