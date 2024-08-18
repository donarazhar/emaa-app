<?php
// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Deklarasi kelas LaporKerja yang merupakan turunan dari Model Eloquent Laravel
class LaporKerja extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    use HasFactory;

    // Menentukan nama tabel yang diwakili oleh model ini
    protected $table = 'laporkerjas';

    // Mendefinisikan bahwa kolom 'foto_laporkerja' akan diperlakukan sebagai array
    protected $casts = [
        'foto_laporkerja' => 'array',
        'tgl' => 'date',  // Menambahkan cast untuk 'tgl'
    ];

    // Metode user() mendefinisikan relasi one-to-many atau one-to-one dengan model User
    // Relasi ini berarti bahwa setiap instance LaporKerja berhubungan dengan satu instance User
    // Parameter pertama `User::class` adalah nama model yang dihubungkan
    // Parameter kedua `'email_user'` adalah nama kolom dalam tabel laporkerjas yang menjadi foreign key
    // Parameter ketiga `'email'` adalah nama kolom pada tabel users yang menjadi primary key yang dihubungkan
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email_user', 'email');
    }

    // Metode setAttributesToProperCase() digunakan untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    // Mutator setJudulAttribute() digunakan untuk mengatur nilai dari atribut 'judul'
    // Saat nilai 'judul' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $this->setAttributesToProperCase($value);
    }

    // Mutator setIsiAttribute() digunakan untuk mengatur nilai dari atribut 'isi'
    // Saat nilai 'isi' diset, nilai tersebut akan diubah menjadi Proper Case menggunakan metode setAttributesToProperCase()
    public function setIsiAttribute($value)
    {
        $this->attributes['isi'] = $this->setAttributesToProperCase($value);
    }
}
