<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function pembayarans()
    {
        return $this->hasMany(KursusPembayaran::class, 'kursus_pendaftaran_id');
    }


    public function getCombinedInfoAttribute()
    {
        $jamMulai = Carbon::parse($this->jadwal->jam_mulai)->format('H:i');
        $jamSelesai = Carbon::parse($this->jadwal->jam_selesai)->format('H:i');

        // Mengubah jenis_kursus menjadi huruf kapital
        $jenisKursus = strtoupper($this->jadwal->kategori->jenis_kursus);

        return $this->murid->nama . ' | ' . $this->jadwal->kategori->guru->nama . ' - ' . $this->jadwal->kategori->nama_kursus . ' (' . $this->jadwal->hari . ' | ' . $jamMulai . ' s/d ' . $jamSelesai  . ' | ' . $jenisKursus . ') ';
    }
}
