<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas InventarisMerk yang merupakan turunan dari Model Eloquent Laravel
class InventarisMerk extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisMerk dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator untuk atribut 'nama_merk'
    // Saat nilai 'nama_merk' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setNamaMerkAttribute($value)
    {
        $this->attributes['nama_merk'] = $this->setAttributesToProperCase($value);
    }

    // Mutator untuk atribut 'keterangan_merk'
    // Saat nilai 'keterangan_merk' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKeteranganMerkAttribute($value)
    {
        $this->attributes['keterangan_merk'] = $this->setAttributesToProperCase($value);
    }
}
