<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas LayananTransaksiKonsultasi yang merupakan turunan dari Model Eloquent Laravel
class LayananTransaksiKonsultasi extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi belongsTo dengan model LayananImam
    // Setiap instance LayananTransaksiKonsultasi memiliki satu LayananImam yang terkait
    // 'imam_id' adalah foreign key yang menghubungkan tabel layanan_transaksi_konsultasis dengan tabel layanan_imams
    public function imam()
    {
        return $this->belongsTo(LayananImam::class, 'imam_id');
    }

    // Relasi belongsTo dengan model LayananJenisKonsultasi
    // Setiap instance LayananTransaksiKonsultasi memiliki satu LayananJenisKonsultasi yang terkait
    // 'jeniskonsultasi_id' adalah foreign key yang menghubungkan tabel layanan_transaksi_konsultasis dengan tabel layanan_jenis_konsultasis
    public function jeniskonsultasi()
    {
        return $this->belongsTo(LayananJenisKonsultasi::class, 'jeniskonsultasi_id');
    }
}
