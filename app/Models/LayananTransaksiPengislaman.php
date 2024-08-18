<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas LayananTransaksiPengislaman yang merupakan turunan dari Model Eloquent Laravel
class LayananTransaksiPengislaman extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi belongsTo dengan model LayananImam
    // Setiap instance LayananTransaksiPengislaman memiliki satu LayananImam yang terkait
    // 'imam_id' adalah foreign key yang menghubungkan tabel layanan_transaksi_pengislamans dengan tabel layanan_imams
    public function imam()
    {
        return $this->belongsTo(LayananImam::class, 'imam_id');
    }
}
