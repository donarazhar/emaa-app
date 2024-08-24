<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(BlogArticleKategori::class, 'blog_article_kategori_id');
    }
}
