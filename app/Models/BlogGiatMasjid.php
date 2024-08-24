<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogGiatMasjid extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(BlogGiatMasjidKategori::class, 'blog_giat_masjid_kategori_id');
    }
}
