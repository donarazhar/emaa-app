<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas SuratKategori yang merupakan turunan dari Model Eloquent Laravel
class SuratKategori extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Metode setAttributesToProperCase() digunakan untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator setNamaKategoriAttribute() digunakan untuk mengatur nilai dari atribut 'nama_kategori'
    // Saat nilai 'nama_kategori' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['nama_kategori'] = $this->setAttributesToProperCase($value);
    }

    // Mutator setKeteranganKategoriAttribute() digunakan untuk mengatur nilai dari atribut 'keterangan_kategori'
    // Saat nilai 'keterangan_kategori' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKeteranganKategoriAttribute($value)
    {
        $this->attributes['keterangan_kategori'] = $this->setAttributesToProperCase($value);
    }
}
