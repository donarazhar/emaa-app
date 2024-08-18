<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas InventarisKategori yang merupakan turunan dari Model Eloquent Laravel
class InventarisKategori extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi one-to-many dengan model InventarisTransaksi
    // Setiap instance InventarisKategori dapat memiliki banyak InventarisTransaksi yang terkait
    public function inventarisTransaksis()
    {
        return $this->hasMany(InventarisTransaksi::class);
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator untuk atribut 'nama_kategori'
    // Saat nilai 'nama_kategori' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKategoriInventarisAttribute($value)
    {
        $this->attributes['nama_kategori'] = $this->setAttributesToProperCase($value);
    }

    // Mutator untuk atribut 'keterangan_kategori'
    // Saat nilai 'keterangan_kategori' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKeteranganKategoriAttribute($value)
    {
        $this->attributes['keterangan_kategori'] = $this->setAttributesToProperCase($value);
    }
}
