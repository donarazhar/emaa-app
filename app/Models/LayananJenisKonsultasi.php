<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananJenisKonsultasi extends Model
{
    use HasFactory;

    // Relasi hasMany dengan model LayananTransaksiKonsultasi
    public function transaksiKonsultasi()
    {
        return $this->hasMany(LayananTransaksiKonsultasi::class, 'jeniskonsultasi_id');
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNamaJenisKonsultasiAttribute($value)
    {
        $this->attributes['nama_jenis_konsultasi'] = $this->setAttributesToProperCase($value);
    }

    public function setDeskripsiAttribute($value)
    {
        $this->attributes['deskripsi'] = $this->setAttributesToProperCase($value);
    }
}
