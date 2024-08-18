<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas InventarisSuplier yang merupakan turunan dari Model Eloquent Laravel
class InventarisSuplier extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisSuplier dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }
}
