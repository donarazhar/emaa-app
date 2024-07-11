<?php

namespace Database\Seeders;

use App\Models\InventarisMerk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarisMerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa entri dengan data palsu
        InventarisMerk::factory()->count(5)->create();
    }
}
