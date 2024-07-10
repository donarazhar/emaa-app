<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananTransaksiKonsultasi extends Model
{
    use HasFactory;

    public function imam()
    {
        return $this->belongsTo(LayananImam::class, 'imam_id');
    }

    public function jeniskonsultasi()
    {
        return $this->belongsTo(LayananJenisKonsultasi::class, 'jeniskonsultasi_id');
    }
}
