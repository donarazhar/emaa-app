<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTransaksi extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(SuratKategori::class, 'kategori_surat_id');
    }

    public function asal()
    {
        return $this->belongsTo(SuratAsal::class, 'asal_surat_id');
    }
}
