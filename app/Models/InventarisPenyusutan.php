<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisPenyusutan extends Model
{
    use HasFactory;

    public function inventarisTransaksi()
    {
        return $this->belongsTo(InventarisTransaksi::class, 'inventaris_transaksi_id');
    }
}
