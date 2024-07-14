<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusKategori extends Model
{
    use HasFactory;

    public function guru()
    {
        return $this->belongsTo(KursusGuru::class, 'kursus_guru_id');
    }

    public function jadwals()
    {
        return $this->hasMany(KursusJadwal::class, 'kursus_kategori_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class);
    }

    public function penilaians()
    {
        return $this->hasMany(KursusPenilaian::class);
    }
}
