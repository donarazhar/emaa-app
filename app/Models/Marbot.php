<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marbot extends Model
{
    use HasFactory;
   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email_user', 'email');
    }

    public function keluargas()
    {
        return $this->belongsToMany(MarbotKeluarga::class, 'marbot_has_keluargas', 'marbot_id', 'marbot_keluarga_id');
    }

    public function riwayatkepegawaians()
    {
        return $this->belongsToMany(MarbotRiwayatKepegawaian::class, 'marbot_has_riwayat_kepegawaians', 'marbot_id', 'marbot_riwayat_kepegawaian_id');
    }

    public function kesehatans()
    {
        return $this->belongsToMany(MarbotKesehatan::class, 'marbot_has_kesehatans', 'marbot_id', 'marbot_kesehatan_id');
    }

}
