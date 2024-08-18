<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas KasKecilMatanggaran yang merupakan turunan dari Model Eloquent Laravel
class KasKecilMatanggaran extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Relasi belongsTo dengan model KasKecilAas
    // Setiap instance KasKecilMatanggaran terkait dengan satu instance KasKecilAas
    // 'kode_aas' adalah foreign key yang menghubungkan tabel kas_kecil_matanggarans dengan tabel kas_kecil_aass
    public function aas()
    {
        return $this->belongsTo(KasKecilAas::class, 'kode_aas', 'kode_aas');
    }

    // Accessor untuk atribut 'kodes_matanggaran'
    // Menggabungkan 'kode_matanggaran' dan 'nama_aas' (dari relasi aas) menjadi satu string yang dipisahkan oleh ' - '
    public function getKodesMatanggaranAttribute()
    {
        return $this->kode_matanggaran . ' - ' . $this->aas->nama_aas;
    }

    // Relasi one-to-many dengan model KasKecilTransaksi
    // Setiap instance KasKecilMatanggaran dapat memiliki banyak KasKecilTransaksi yang terkait
    // 'kode_matanggaran' adalah foreign key di tabel kas_kecil_transaksis yang menghubungkan dengan kolom 'kode_matanggaran' di tabel kas_kecil_matanggarans
    public function transaksis()
    {
        return $this->hasMany(KasKecilTransaksi::class, 'kode_matanggaran', 'kode_matanggaran');
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }
}
