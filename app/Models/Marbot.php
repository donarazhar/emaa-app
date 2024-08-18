<?php

// Deklarasi namespace untuk model ini
namespace App\Models;

// Import trait dan kelas yang akan digunakan dalam model ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;

// Deklarasi kelas Marbot yang merupakan turunan dari Model Eloquent Laravel
class Marbot extends Model
{
    // Menggunakan trait HasFactory untuk memungkinkan pembuatan instance model menggunakan factory
    // Menggunakan trait HasRoles untuk mengelola peran dan izin yang dimiliki oleh model
    use HasFactory, HasRoles;

    // Metode user() mendefinisikan relasi one-to-many atau one-to-one dengan model User
    // Relasi ini berarti bahwa setiap instance Marbot berhubungan dengan satu instance User
    // Parameter pertama `User::class` adalah nama model yang dihubungkan
    // Parameter kedua `'email_user'` adalah nama kolom dalam tabel marbot yang menjadi foreign key
    // Parameter ketiga `'email'` adalah nama kolom pada tabel users yang menjadi primary key yang dihubungkan
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email_user', 'email');
    }

    // Metode keluargas() mendefinisikan relasi many-to-many dengan model MarbotKeluarga
    // Relasi ini berarti bahwa setiap instance Marbot dapat berhubungan dengan banyak instance MarbotKeluarga
    // Parameter pertama `MarbotKeluarga::class` adalah nama model yang dihubungkan
    // Parameter kedua `'marbot_has_keluargas'` adalah nama tabel pivot (tabel penghubung)
    // Parameter ketiga `'marbot_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model ini (Marbot)
    // Parameter keempat `'marbot_keluarga_id'` adalah nama kolom foreign key di tabel pivot yang menghubungkan dengan model MarbotKeluarga
    public function keluargas()
    {
        return $this->belongsToMany(MarbotKeluarga::class, 'marbot_has_keluargas', 'marbot_id', 'marbot_keluarga_id');
    }

    // Metode riwayatkepegawaians() mendefinisikan relasi many-to-many dengan model MarbotRiwayatKepegawaian
    // Logika dan parameter sama seperti pada relasi keluargas()
    public function riwayatkepegawaians()
    {
        return $this->belongsToMany(MarbotRiwayatKepegawaian::class, 'marbot_has_riwayat_kepegawaians', 'marbot_id', 'marbot_riwayat_kepegawaian_id');
    }

    // Metode kesehatans() mendefinisikan relasi many-to-many dengan model MarbotKesehatan
    // Logika dan parameter sama seperti pada relasi keluargas()
    public function kesehatans()
    {
        return $this->belongsToMany(MarbotKesehatan::class, 'marbot_has_kesehatans', 'marbot_id', 'marbot_kesehatan_id');
    }
}
