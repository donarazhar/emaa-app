<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasKecilTransaksi;

class KasKecilController extends Controller
{
    public function cetakPengisianKas($id)
    {
        $transaksi = KasKecilTransaksi::findOrFail($id);

        return view('kaskecil.cetak-pengisiankas', compact('transaksi'));
    }
}
