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

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }
    
    public function setPerincianAttribute($value)
    {
        $this->attributes['perincian'] = $this->setAttributesToProperCase($value);
    }

}
