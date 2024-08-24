<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogGiatMasjidKategori extends Model
{
    use HasFactory;


    public function giatMasjids()
    {
        return $this->hasMany(BlogGiatMasjid::class, 'blog_giat_masjid_kategori_id');
    }
}
