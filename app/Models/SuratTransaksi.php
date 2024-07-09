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
        $year = date('Y');
        $lastEntry = DB::table('surat_transaksis')
            ->whereYear('created_at', $year)
            ->orderBy('no_transaksi_surat', 'desc')
            ->first();

        $lastNumber = $lastEntry ? intval(explode('_', $lastEntry->no_transaksi_surat)[0]) : 0;
        $newNumber = $lastNumber + 1;

        return $newNumber . '_' . $year;
    }
}
