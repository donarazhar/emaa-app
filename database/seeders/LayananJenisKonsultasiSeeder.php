<?php

namespace Database\Seeders;

use App\Models\LayananJenisKonsultasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananJenisKonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        LayananJenisKonsultasi::factory()->count(3)->create();
    }
}
