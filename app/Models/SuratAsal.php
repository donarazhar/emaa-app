<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratAsal extends Model
{
    use HasFactory;

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }
    
    public function setNamaAsalSuratAttribute($value)
    {
        $this->attributes['nama_asal_surat'] = $this->setAttributesToProperCase($value);
    }
    
    public function setKeteranganAsalSuratAttribute($value)
    {
        $this->attributes['keterangan_asal_surat'] = $this->setAttributesToProperCase($value);
    }
}
