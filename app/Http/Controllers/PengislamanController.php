<?php

namespace App\Http\Controllers;

use App\Models\LayananTransaksiPengislaman;
use Illuminate\Http\Request;

class PengislamanController extends Controller
{
    public function preview($id)
    {
        $pengislaman = LayananTransaksiPengislaman::with(['imam'])->findOrFail($id);
        return view('pengislaman.previewpdf', compact('pengislaman'));
    }
}
