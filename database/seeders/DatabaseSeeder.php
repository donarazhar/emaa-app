<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Marbot;
use App\Models\Keluarga;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SuratAsal;
use App\Models\LayananImam;
use App\Models\SuratKategori;
use App\Models\InventarisMerk;
use App\Models\InventarisBagian;
use App\Models\InventarisSatuan;
use App\Models\InventarisKategori;
use App\Models\LayananJenisKonsultasi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Donar Azhar',
            'email' => 'donar@email.com',
            'password' => bcrypt('1234'),
            'foto' => 'file-user/avatar.png',
            'role' => 'admin',
            'phone' => '088214740182',
        ]);

        // Membuat beberapa entri dengan data palsu
        Marbot::factory()->count(5)->has(Keluarga::factory()->count(3))->create();
        InventarisBagian::factory()->count(2)->create();
        InventarisKategori::factory()->count(3)->create();
        InventarisMerk::factory()->count(5)->create();
        InventarisSatuan::factory()->count(10)->create();
        LayananImam::factory()->count(5)->create();
        LayananJenisKonsultasi::factory()->count(3)->create();
        SuratAsal::factory()->count(5)->create();
        SuratKategori::factory()->count(3)->create();
        Keluarga::factory()->count(3)->create();

        $this->call([
            StandardSeeder::class,
        ]);
    }
}
