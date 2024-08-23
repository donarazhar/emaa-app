<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananImam extends Model
{
    use HasFactory;

    // Relasi hasMany dengan model LayananTransaksiKonsultasi
    public function transaksiKonsultasi()
    {
        return $this->hasMany(LayananTransaksiKonsultasi::class, 'imam_id');
    }

    // Relasi hasMany dengan model LayananTransaksiPengislaman
    public function transaksiPengislaman()
    {
        return $this->hasMany(LayananTransaksiPengislaman::class, 'imam_id');
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaImamAttribute($value)
    {
        $this->attributes['nama_imam'] = $this->setAttributesToProperCase($value);
    }

    public function setKeteranganAttribute($value)
    {
        $this->attributes['keterangan'] = $this->setAttributesToProperCase($value);
    }
}
