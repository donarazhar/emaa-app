<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusPendaftaran extends Model
{
    use HasFactory;

    public function murid()
    {
        return $this->belongsTo(KursusMurid::class, 'kursus_murid_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(KursusJadwal::class, 'kursus_jadwal_id');
    }

    public function getCombinedInfoAttribute()
    {
        return $this->murid->nama . ' - ' . $this->jadwal->kursuskategori->guru->nama . ' - ' . $this->jadwal->kursuskategori->nama_kursus . ' ( ' . $this->jadwal->hari . ' - ' . $this->jadwal->jam_mulai . ' s/d ' . $this->jadwal->jam_selesai . ' )';
    }
}
