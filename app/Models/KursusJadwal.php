<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusJadwal extends Model
{
    use HasFactory;
    protected $fillable = ['kursus_kategori_id', 'hari', 'waktu_mulai', 'waktu_selesai'];

    public function kursuskategoris()
    {
        return $this->belongsTo(KursusKategori::class, 'kursus_kategori_id');
    }

    public function guru()
    {
        return $this->belongsTo(KursusGuru::class, 'kursus_guru_id');
    }

    public function getCombinedInfoAttribute()
    {
        return $this->kursuskategoris->guru->nama . ' -' . $this->kursuskategoris->nama_kursus . ' ( ' . $this->hari . ' - ' . $this->waktu_mulai . ' s/d ' . $this->waktu_selesai . ' )';
    }

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class, 'kursus_jadwal_id');
    }

    public function absensis()
    {
        return $this->hasMany(KursusAbsensi::class);
    }
}
