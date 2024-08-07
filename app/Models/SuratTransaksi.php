<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratTransaksi extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(SuratKategori::class, 'kategori_surat_id');
    }

    public function asal()
    {
        return $this->belongsTo(SuratAsal::class, 'asal_surat_id');
    }

    public static function generateNoUrutSurat()
    {
        $month = date('m');
        $year = date('Y');

        $lastEntry = DB::table('surat_transaksis')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();

        $lastNumber = $lastEntry ? intval(explode('/', $lastEntry->id)[0]) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Pad the number to 4 digits

        return $newNumber . '/' . $month . '/' . $year;
    }
}
