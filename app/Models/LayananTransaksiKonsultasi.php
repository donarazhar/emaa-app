<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananTransaksiKonsultasi extends Model
{
    use HasFactory;

    // Relasi belongsTo dengan model LayananImam
    public function imam()
    {
        return $this->belongsTo(LayananImam::class, 'imam_id');
    }

    // Relasi belongsTo dengan model LayananJenisKonsultasi
    public function jeniskonsultasi()
    {
        return $this->belongsTo(LayananJenisKonsultasi::class, 'jeniskonsultasi_id');
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaJamaahAttribute($value)
    {
        $this->attributes['nama_jamaah'] = $this->setAttributesToProperCase($value);
    }

    public function setTempatLahirJamaahAttribute($value)
    {
        $this->attributes['tempat_lahir_jamaah'] = $this->setAttributesToProperCase($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = $this->setAttributesToProperCase($value);
    }

    public function setPekerjaanAttribute($value)
    {
        $this->attributes['pekerjaan'] = $this->setAttributesToProperCase($value);
    }

    public function setDeskripsiMasalahAttribute($value)
    {
        $this->attributes['deskripsi_masalah'] = $this->setAttributesToProperCase($value);
    }
}
