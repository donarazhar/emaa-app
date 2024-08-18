<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Deklarasi kelas KasKecilTransaksi yang merupakan turunan dari Model Eloquent Laravel
class KasKecilTransaksi extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Mendefinisikan bahwa kolom 'foto_kaskecil' akan diperlakukan sebagai array
    protected $casts = [
        'foto_kaskecil' => 'array',
    ];

    // Relasi belongsTo dengan model KasKecilMatanggaran
    // Setiap instance KasKecilTransaksi terkait dengan satu instance KasKecilMatanggaran
    // 'kode_matanggaran' adalah foreign key yang menghubungkan tabel kas_kecil_transaksis dengan tabel kas_kecil_matanggarans
    public function matanggaran()
    {
        return $this->belongsTo(KasKecilMatanggaran::class, 'kode_matanggaran', 'kode_matanggaran');
    }

    // Metode untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator untuk atribut 'perincian'
    // Saat nilai 'perincian' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setPerincianAttribute($value)
    {
        $this->attributes['perincian'] = $this->setAttributesToProperCase($value);
    }
}
