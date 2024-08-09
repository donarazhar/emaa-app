<?php

namespace App\Http\Controllers;

use App\Models\LayananTransaksiKonsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function preview($id)
    {
        $konsultasi = LayananTransaksiKonsultasi::with(['imam', 'jeniskonsultasi'])->findOrFail($id);
        return view('konsultasi.previewpdf', compact('konsultasi'));
    }
}
