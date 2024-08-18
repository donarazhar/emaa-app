<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas LayananJenisKonsultasi yang merupakan turunan dari Model Eloquent Laravel
class LayananJenisKonsultasi extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi hasMany dengan model LayananTransaksiKonsultasi
    // Setiap instance LayananJenisKonsultasi dapat memiliki banyak LayananTransaksiKonsultasi yang terkait
    public function transaksiKonsultasi()
    {
        return $this->hasMany(LayananTransaksiKonsultasi::class, 'jeniskonsultasi_id');
    }
}
