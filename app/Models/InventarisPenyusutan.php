<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisPenyusutan extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    public function inventarisTransaksi()
    {
        return $this->belongsTo(InventarisTransaksi::class, 'inventaris_transaksi_id');
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setKeteranganPenyusutanAttribute($value)
    {
        $this->attributes['keterangan_penyusutan'] = $this->setAttributesToProperCase($value);
    }
}
