<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas LayananImam yang merupakan turunan dari Model Eloquent Laravel
class LayananImam extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi hasMany dengan model LayananTransaksiKonsultasi
    // Setiap instance LayananImam dapat memiliki banyak LayananTransaksiKonsultasi yang terkait
    public function transaksiKonsultasi()
    {
        return $this->hasMany(LayananTransaksiKonsultasi::class, 'imam_id');
    }

    // Relasi hasMany dengan model LayananTransaksiPengislaman
    // Setiap instance LayananImam dapat memiliki banyak LayananTransaksiPengislaman yang terkait
    public function transaksiPengislaman()
    {
        return $this->hasMany(LayananTransaksiPengislaman::class, 'imam_id');
    }
}
