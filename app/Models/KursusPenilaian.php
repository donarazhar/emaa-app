<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusPenilaian extends Model
{
    use HasFactory;

    public function murid()
    {
        return $this->belongsTo(KursusMurid::class);
    }

    public function kursuskategoris()
    {
        return $this->belongsTo(KursusKategori::class);
    }
}
