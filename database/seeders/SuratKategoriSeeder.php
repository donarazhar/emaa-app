<?php

namespace Database\Seeders;

use App\Models\SuratKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        SuratKategori::factory()->count(3)->create();
    }
}
