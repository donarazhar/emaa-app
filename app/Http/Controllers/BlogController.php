<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use App\Models\BlogArticleKategori;
use App\Models\BlogBanner;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function web()
    {
        return view('index');
    }

    public function blog()
    {
        $banner = BlogBanner::all();
        $tabs = BlogArticleKategori::all();
        $artikel = BlogArticle::orderBy('tanggal_jam', 'desc')->get();

        return view('blog', compact('banner', 'tabs', 'artikel'));
    }

    public function show($id)
    {
        $artikel = BlogArticle::findOrFail($id);
        return view('blogshow', compact('artikel'));
    }
}
