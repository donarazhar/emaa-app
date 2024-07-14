<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusGuru extends Model
{
    use HasFactory;

    public function kursuskategoris()
    {
        return $this->hasMany(KursusKategori::class, 'kursus_kategori_id');
    }

    public function jadwals()
    {
        return $this->hasMany(KursusJadwal::class, 'kursus_guru_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(KursusPendaftaran::class);
    }
}
