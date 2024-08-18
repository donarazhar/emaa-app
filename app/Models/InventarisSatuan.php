<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas InventarisSatuan yang merupakan turunan dari Model Eloquent Laravel
class InventarisSatuan extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisSatuan dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator untuk atribut 'nama_satuan'
    // Saat nilai 'nama_satuan' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setNamaSatuanAttribute($value)
    {
        $this->attributes['nama_satuan'] = $this->setAttributesToProperCase($value);
    }

    // Mutator untuk atribut 'keterangan_satuan'
    // Saat nilai 'keterangan_satuan' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKeteranganSatuanAttribute($value)
    {
        $this->attributes['keterangan_satuan'] = $this->setAttributesToProperCase($value);
    }
}
