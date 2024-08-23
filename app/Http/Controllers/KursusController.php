<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KursusPembayaran;
use App\Models\KursusPendaftaran;

class KursusController extends Controller
{
    public function preview($id)
    {
        $pendaftaran = KursusPendaftaran::with(['murid', 'jadwal', 'pembayarans'])->findOrFail($id);
        return view('kursus.previewpdf', compact('pendaftaran'));
    }

    public function generateKwitansiNumber()
    {
        // Mengambil nomor urut terakhir dari database
        $lastInvoice = KursusPembayaran::orderBy('id', 'desc')->first();

        // Tentukan nomor urut berikutnya
        $nextNumber = $lastInvoice ? intval(explode('/', $lastInvoice->nomor_kwitansi)[0]) + 1 : 1;

        // Format nomor urut menjadi 3 digit
        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Ambil bulan dan tahun saat ini
        $currentMonth = now()->format('n'); // Menghasilkan angka bulan
        $romanMonth = $this->convertToRoman($currentMonth); // Konversi ke format Romawi
        $currentYear = now()->format('Y');

        // Gabungkan semua bagian untuk menghasilkan nomor kwitansi
        $kwitansiNumber = "{$formattedNumber}/KURSUS-YPIAA/{$romanMonth}/{$currentYear}";

        return $kwitansiNumber;
    }

    // Fungsi untuk mengkonversi angka bulan ke format Romawi
    private function convertToRoman($number)
    {
        $map = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function kwitansi($id)
    {
        // Mengambil data pembayaran beserta relasi pendaftaran
        $pembayaran = KursusPembayaran::with(['pendaftaran.jadwal.kategori.guru', 'pendaftaran.murid'])->findOrFail($id);

        // Generate nomor kwitansi
        $nomor_kwitansi = $this->generateKwitansiNumber();

        // Mengirim data pembayaran ke view 'kursus.previewkwitansi'
        return view('kursus.previewkwitansi', compact('pembayaran', 'nomor_kwitansi'));
    }
}
