<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusMurid extends Model
{
    use HasFactory;

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class);
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
}
