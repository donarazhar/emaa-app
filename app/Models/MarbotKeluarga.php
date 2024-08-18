<?php

// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas MarbotKeluarga yang merupakan turunan dari Model Eloquent Laravel
class MarbotKeluarga extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Metode marbots() mendefinisikan relasi many-to-many dengan model Marbot
    // Relasi ini berarti bahwa setiap instance MarbotKeluarga dapat berhubungan dengan banyak instance Marbot
    // Parameter pertama `Marbot::class` adalah nama model yang dihubungkan
    // Parameter kedua `'marbot_has_keluargas'` adalah nama tabel pivot (tabel penghubung)
    // Parameter ketiga `'marbot_keluarga_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model ini (MarbotKeluarga)
    // Parameter keempat `'marbot_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model Marbot
    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'marbot_has_keluargas', 'marbot_keluarga_id', 'marbot_id');
    }
}
