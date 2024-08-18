<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas MarbotRiwayatKepegawaian yang merupakan turunan dari Model Eloquent Laravel
class MarbotRiwayatKepegawaian extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Metode marbots() mendefinisikan relasi many-to-many dengan model Marbot
    // Relasi ini berarti bahwa setiap instance MarbotRiwayatKepegawaian dapat berhubungan dengan banyak instance Marbot
    // Parameter pertama `Marbot::class` adalah nama model yang dihubungkan
    // Parameter kedua `'marbot_has_riwayat_kepegawaians'` adalah nama tabel pivot (tabel penghubung)
    // Parameter ketiga `'marbot_riwayat_kepegawaian_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model ini (MarbotRiwayatKepegawaian)
    // Parameter keempat `'marbot_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model Marbot
    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'marbot_has_riwayat_kepegawaians', 'marbot_riwayat_kepegawaian_id', 'marbot_id');
    }
}
