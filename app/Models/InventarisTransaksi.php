<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisTransaksi extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(InventarisKategori::class, 'kategori_id');
    }

    public function merk()
    {
        return $this->belongsTo(InventarisMerk::class, 'merk_id');
    }

    public function satuan()
    {
        return $this->belongsTo(InventarisSatuan::class, 'satuan_id');
    }

    public function bagian()
    {
        return $this->belongsTo(InventarisBagian::class, 'bagian_id');
    }
}
