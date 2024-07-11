<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananTransaksiPengislaman extends Model
{
    use HasFactory;

    public function imam()
    {
        return $this->belongsTo(LayananImam::class, 'imam_id');
    }
}
