<?php

namespace Database\Seeders;

use App\Models\SuratAsal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratAsalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        SuratAsal::factory()->count(5)->create();
    }
}
