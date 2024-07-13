<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKecilAas extends Model
{
    use HasFactory;

    public function matanggaran()
    {
        return $this->hasMany(KasKecilMatanggaran::class, 'aas_id', 'id');
    }
}
