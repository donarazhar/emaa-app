<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marbot extends Model
{
    use HasFactory;

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
}
