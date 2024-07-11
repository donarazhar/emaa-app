<?php

namespace Database\Seeders;

use App\Models\InventarisBagian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarisBagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        InventarisBagian::factory()->count(2)->create();
    }
}
