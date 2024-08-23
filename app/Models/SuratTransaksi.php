<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

// Deklarasi kelas SuratTransaksi yang merupakan turunan dari Model Eloquent Laravel
class SuratTransaksi extends Model
{
    use HasFactory;

    // Mendefinisikan relasi belongsTo antara model SuratTransaksi dan SuratKategori
    public function kategori()
    {
        return $this->belongsTo(SuratKategori::class, 'kategori_surat_id');
    }

    // Mendefinisikan relasi belongsTo antara model SuratTransaksi dan SuratAsal
    public function asal()
    {
        return $this->belongsTo(SuratAsal::class, 'asal_surat_id');
    }

    // Metode statis generateNoUrutSurat() digunakan untuk menghasilkan nomor urut surat berdasarkan bulan dan tahun saat ini
    public static function generateNoUrutSurat()
    {
        $month = date('m');
        $year = date('Y');

        // Mengambil entri terakhir dari tabel 'surat_transaksis' berdasarkan bulan dan tahun saat ini
        $lastEntry = DB::table('surat_transaksis')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();

        // Jika ada entri sebelumnya, ambil nomor urut terakhir; jika tidak, mulai dari 0
        $lastNumber = $lastEntry ? intval(explode('/', $lastEntry->id)[0]) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Tambahkan padding untuk memastikan nomor memiliki 4 digit

        // Mengembalikan nomor urut baru dalam format yang diinginkan
        return $newNumber . '/' . $month . '/' . $year;
    }

    // Metode setAttributesToProperCase() digunakan untuk mengubah string menjadi format Proper Case (huruf pertama setiap kata kapital)
    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setPerihalTransaksiSuratAttribute($value)
    {
        $this->attributes['perihal_transaksi_surat'] = $this->setAttributesToProperCase($value);
    }

    public function setSuratDariTransaksiSuratAttribute($value)
    {
        $this->attributes['surat_dari_transaksi_surat'] = $this->setAttributesToProperCase($value);
    }

    public function setDisposisiTransaksiSuratAttribute($value)
    {
        $this->attributes['disposisi_transaksi_surat'] = $this->setAttributesToProperCase($value);
    }
}
