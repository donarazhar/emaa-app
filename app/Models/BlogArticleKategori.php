<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArticleKategori extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'blog_article_kategori_id');
    }
}
