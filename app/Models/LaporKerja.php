<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporKerja extends Model
{
    use HasFactory;

    protected $table = 'laporkerjas';

    protected $casts = [
        'foto_laporkerja' => 'array',
    ];
    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
