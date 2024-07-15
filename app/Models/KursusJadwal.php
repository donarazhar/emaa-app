<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusJadwal extends Model
{
    use HasFactory;

    public function kursuskategori()
    {
        return $this->belongsTo(KursusKategori::class, 'kursus_kategori_id');
    }

    public function getCombinedInfoAttribute()
    {
        return $this->kursuskategori->guru->nama . ' -' . $this->kursuskategori->nama_kursus . ' ( ' . $this->hari . ' - ' . $this->jam_mulai . ' s/d ' . $this->jam_selesai . ' )';
    }
}
