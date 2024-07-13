<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marbot extends Model
{
    use HasFactory;

    protected $casts = [
        'kesehatan' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function keluargas()
    {
        return $this->belongsToMany(Keluarga::class);
    }

    public function sertifikats()
    {
        return $this->hasMany(SertifikatMarbot::class);
    }
}
