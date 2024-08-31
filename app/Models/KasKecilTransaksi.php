<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKecilTransaksi extends Model
{
    use HasFactory;

    protected $casts = [
        'foto_kaskecil' => 'array',
    ];


    public function matanggaran()
    {
        return $this->belongsTo(KasKecilMatanggaran::class, 'kode_matanggaran', 'kode_matanggaran');
    }

    // Method untuk mengambil pengisian_id terakhir dengan kategori 'pengisian'
    public static function getLastPengisianId()
    {
        return self::where('kategori', 'pengisian')
            ->max('pengisian_id');
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }

    public function setPerincianAttribute($value)
    {
        $this->attributes['perincian'] = $this->setAttributesToProperCase($value);
    }
}
