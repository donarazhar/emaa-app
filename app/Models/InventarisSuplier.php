<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisSuplier extends Model
{
    use HasFactory;

    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }
}
