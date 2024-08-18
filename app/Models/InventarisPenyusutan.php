<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas InventarisPenyusutan yang merupakan turunan dari Model Eloquent Laravel
class InventarisPenyusutan extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi belongsTo dengan model InventarisTransaksi
    // Setiap instance InventarisPenyusutan terkait dengan satu instance InventarisTransaksi
    // 'inventaris_transaksi_id' adalah foreign key yang menghubungkan tabel inventaris_penyusutans dengan tabel inventaris_transaksis
    public function inventarisTransaksi()
    {
        return $this->belongsTo(InventarisTransaksi::class, 'inventaris_transaksi_id');
    }
}
