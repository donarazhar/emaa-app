<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas SuratAsal yang merupakan turunan dari Model Eloquent Laravel
class SuratAsal extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Metode setAttributesToProperCase() digunakan untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator setNamaAsalSuratAttribute() digunakan untuk mengatur nilai dari atribut 'nama_asal_surat'
    // Saat nilai 'nama_asal_surat' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setNamaAsalSuratAttribute($value)
    {
        $this->attributes['nama_asal_surat'] = $this->setAttributesToProperCase($value);
    }

    // Mutator setKeteranganAsalSuratAttribute() digunakan untuk mengatur nilai dari atribut 'keterangan_asal_surat'
    // Saat nilai 'keterangan_asal_surat' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setKeteranganAsalSuratAttribute($value)
    {
        $this->attributes['keterangan_asal_surat'] = $this->setAttributesToProperCase($value);
    }
}
