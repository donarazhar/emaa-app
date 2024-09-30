<?php

namespace App\Http\Controllers;

use App\Models\BlogBanner;
use App\Models\BlogArticle;
use Illuminate\Http\Request;
use App\Models\BlogProfileMasjid;
use App\Models\BlogArticleKategori;
use App\Models\BlogBuletin;
use App\Models\BlogDonasi;
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
        $donasi = BlogDonasi::orderBy('created_at', 'desc')->take(4)->get();

        // Loop untuk mendapatkan 6 artikel terbaru untuk setiap kategori
        $artikel = [];
        foreach ($tabs as $tab) {
            $artikel[$tab->id] = BlogArticle::where('blog_article_kategori_id', $tab->id)
                ->orderBy('tanggal_jam', 'desc')
                ->take(6)
                ->get();
        }

        return view('blog.blog', compact('banner', 'tabs', 'artikel', 'donasi'));
    }

    public function privacy()
    {
        return view('blog.privacy');
    }

    public function show($id)
    {
        $artikel = BlogArticle::findOrFail($id);
        return view('blog.blogshow', compact('artikel'));
    }

    public function viewAll(Request $request, $categoryId)
    {
        $kategori = BlogArticleKategori::find($categoryId);
        $search = $request->input('search');
        $articlesQuery = BlogArticle::where('blog_article_kategori_id', $categoryId)->orderBy('tanggal_jam', 'desc');

        if ($search) {
            $articlesQuery->where('judul', 'like', '%' . $search . '%')
                ->orWhere('isi', 'like', '%' . $search . '%');
        }

        $articles = $articlesQuery->paginate(6);

        return view('blog.viewall', compact('kategori', 'articles', 'search'));
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

    public function donasi()
    {
        $donasi = BlogDonasi::orderBy('created_at', 'desc')->take(4)->get();
        return view('blog.donasi', compact('donasi'));
    }

    public function allArticles(Request $request)
    {
        $search = $request->input('search');
        $articles = BlogArticle::query();

        if ($search) {
            $articles = $articles->where('judul', 'like', '%' . $search . '%');
        }

        $articles = $articles->orderBy('tanggal_jam', 'desc')->paginate(10);

        return view('blog.all-articles', compact('articles', 'search'));
    }

    public function buletin(Request $request)
    {
        $search = $request->input('search');
        $buletin = BlogBuletin::query();

        if ($search) {
            $buletin = $buletin->where('judul', 'like', '%' . $search . '%');
        }

        $buletin = $buletin->orderBy('tanggal_jam', 'desc')->paginate(10);

        return view('blog.buletin', compact('buletin', 'search'));
    }

    public function buletinshow($id)
    {
        $buletin = BlogBuletin::findOrFail($id);
        return view('blog.buletinshow', compact('buletin'));
    }
}
