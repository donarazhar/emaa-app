<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas InventarisBagian yang merupakan turunan dari Model Eloquent Laravel
class InventarisBagian extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisBagian dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator untuk atribut 'nama_bagian'
    // Saat nilai 'nama_bagian' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setBagianInventarisAttribute($value)
    {
        $this->attributes['nama_bagian'] = $this->setAttributesToProperCase($value);
    }

    // Mutator untuk atribut 'keterangan_bagian'
    // Saat nilai 'keterangan_bagian' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKeteranganBagianAttribute($value)
    {
        $this->attributes['keterangan_bagian'] = $this->setAttributesToProperCase($value);
    }
}
