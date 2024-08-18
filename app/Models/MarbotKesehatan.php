<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas MarbotKesehatan yang merupakan turunan dari Model Eloquent Laravel
class MarbotKesehatan extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Metode marbots() mendefinisikan relasi many-to-many dengan model Marbot
    // Relasi ini berarti bahwa setiap instance MarbotKesehatan dapat berhubungan dengan banyak instance Marbot
    // Parameter pertama `Marbot::class` adalah nama model yang dihubungkan
    // Parameter kedua `'marbot_has_kesehatans'` adalah nama tabel pivot (tabel penghubung)
    // Parameter ketiga `'marbot_kesehatan_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model ini (MarbotKesehatan)
    // Parameter keempat `'marbot_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model Marbot
    public function marbots()
    {
        return $this->belongsToMany(Marbot::class, 'marbot_has_kesehatans', 'marbot_kesehatan_id', 'marbot_id');
    }
}
