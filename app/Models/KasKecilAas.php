<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas KasKecilAas yang merupakan turunan dari Model Eloquent Laravel
class KasKecilAas extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi one-to-many dengan model KasKecilMatanggaran
    // Setiap instance KasKecilAas dapat memiliki banyak KasKecilMatanggaran yang terkait
    // 'kode_aas' adalah foreign key di tabel kas_kecil_matanggarans yang menghubungkan dengan kolom 'kode_aas' di tabel kas_kecil_aass
    public function matanggaran()
    {
        return $this->hasMany(KasKecilMatanggaran::class, 'kode_aas', 'kode_aas');
    }

    // Accessor untuk atribut 'kodes_aas'
    // Menggabungkan 'kode_aas' dan 'nama_aas' menjadi satu string yang dipisahkan oleh ' - '
    public function getKodesAasAttribute()
    {
        return $this->kode_aas . ' - ' . $this->nama_aas;
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator untuk atribut 'nama_aas'
    // Saat nilai 'nama_aas' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setNamaAasAttribute($value)
    {
        $this->attributes['nama_aas'] = $this->setAttributesToProperCase($value);
    }
}
