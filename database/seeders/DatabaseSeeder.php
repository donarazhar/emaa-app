<?php

namespace Database\Seeders;


use App\Models\Keluarga;
use App\Models\Marbot;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Donar Azhar',
            'email' => 'donar@email.com',
            'password' => bcrypt('1234'),
        ]);

        Marbot::factory(10)
            ->has(Keluarga::factory()->count(3))
            ->create();

        $this->call([
            // LayananImamSeeder::class,
            // LayananJenisKonsultasiSeeder::class,
            // InventarisMerkSeeder::class,
            // InventarisBagianSeeder::class,
            // InventarisKategoriSeeder::class,
            // InventarisSatuanSeeder::class,
            // SuratAsalSeeder::class,
            // SuratKategoriSeeder::class,
            // MarbotSeeder::class,
            StandardSeeder::class,
        ]);
    }
}
