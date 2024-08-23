<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KursusJadwal extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(KursusKategori::class, 'kursus_kategori_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class, 'kursus_jadwal_id');
    }

    public function getCombinedInfoAttribute()
    {
        $jamMulai = Carbon::parse($this->jam_mulai)->format('H:i');
        $jamSelesai = Carbon::parse($this->jam_selesai)->format('H:i');

        // Mengubah jenis_kursus menjadi huruf kapital
        $jenisKursus = strtoupper($this->kategori->jenis_kursus);

        return $this->kategori->guru->nama . ' - ' . $this->kategori->nama_kursus . ' (' . $this->hari . ' | ' . $jamMulai . ' s/d ' . $jamSelesai  . ' | ' . $jenisKursus . ') ';
    }
}
