<?php

namespace Database\Seeders;

use App\Models\InventarisSatuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarisSatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        InventarisSatuan::factory()->count(10)->create();
    }
}
