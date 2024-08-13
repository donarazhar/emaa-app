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

    public function cetakLaporanKas($selected, $periodeawal, $periodeakhir)
    {
        // Menguraikan ID rekaman yang dipilih dari URL
        $selectedRecords = explode(',', $selected);

        // Query untuk mengambil data transaksi yang sesuai dengan periode dan ID yang dipilih
        $pengeluaranbulanini = KasKecilTransaksi::whereIn('id', $selectedRecords)
            ->whereBetween('tgl_transaksi', [$periodeawal, $periodeakhir])
            ->get();

        // Menghitung total pengeluaran untuk periode yang dipilih
        $totalpengeluaran = KasKecilTransaksi::whereIn('id', $selectedRecords)
            ->whereBetween('tgl_transaksi', [$periodeawal, $periodeakhir])
            ->where('kategori', 'pengeluaran')
            ->selectRaw('SUM(jumlah) as total_pengeluaran')
            ->first();

        // Mengarahkan ke tampilan cetak dengan data yang diperoleh
        return view('kaskecil.cetak-laporankas', [
            'pengeluaranbulanini' => $pengeluaranbulanini,
            'totalpengeluaran' => $totalpengeluaran,
            'periodeawal' => $periodeawal,
            'periodeakhir' => $periodeakhir,
        ]);
    }
}
