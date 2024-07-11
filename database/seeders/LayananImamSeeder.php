<?php

namespace Database\Seeders;

use App\Models\LayananImam;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LayananImamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        LayananImam::factory()->count(5)->create();
    }
}
