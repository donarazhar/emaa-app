<?php

namespace App\Http\Controllers;

use App\Models\BlogBanner;
use App\Models\BlogArticle;
use Illuminate\Http\Request;
use App\Models\BlogProfileMasjid;
use App\Models\BlogArticleKategori;
use App\Models\BlogGiatMasjid;
use App\Models\BlogGiatMasjidKategori;

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

        return view('blog.blog', compact('banner', 'tabs', 'artikel'));
    }

    public function show($id)
    {
        $artikel = BlogArticle::findOrFail($id);
        return view('blog.blogshow', compact('artikel'));
    }


    public function profile()
    {
        $profile = BlogProfileMasjid::all();
        return view('blog.profile', compact('profile'));
    }

    public function profileShow($id)
    {
        $profile = BlogProfileMasjid::find($id);
        return view('blog.profileshow', compact('profile'));
    }

    public function kegiatan()
    {
        // Ambil semua kategori dan artikel giat masjid
        $tabs = BlogGiatMasjidKategori::with('giatMasjids')->get();

        return view('blog.giatmasjid', compact('tabs'));
    }

    public function giatMasjidShow($id)
    {
        $giatMasjid = BlogGiatMasjid::findOrFail($id);

        return view('blog.giatmasjidshow', compact('giatMasjid'));
    }
}
