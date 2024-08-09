<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\KasKecilTransaksi;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        KasKecilTransaksi::factory()->create([
            'perincian' => 'Pembentukan Kas Kecil',
            'pengisian_id' => null, // NULL jika tidak diisi
            'jumlah' => 25000000,
            'kategori' => 'pembentukan',
            'tgl_transaksi' => '2024-01-01',
            'kode_matanggaran' => '1.1.1', // Pastikan ini sesuai dengan tipe data
            'foto_kaskecil' => null, // NULL jika tidak diisi
            'created_at' => '2024-01-11 11:24:34',
            'updated_at' => '2024-01-11 11:24:34',
        ]);
    }
}
