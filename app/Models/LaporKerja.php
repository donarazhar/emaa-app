<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporKerja extends Model
{
    use HasFactory;

    protected $table = 'laporkerjas';

    protected $casts = [
        'foto_laporkerja' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email_user', 'email');
    }

    public function setAttributesToProperCase($value)
    {
        return ucwords(strtolower($value));
    }
    
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $this->setAttributesToProperCase($value);
    }
    
    public function setIsiAttribute($value)
    {
        $this->attributes['isi'] = $this->setAttributesToProperCase($value);
    }

}
