<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Marbot;
use App\Models\Keluarga;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SuratAsal;
use App\Models\Sertifikat;
use App\Models\KasKecilAas;
use App\Models\LayananImam;
use App\Models\SuratKategori;
use App\Models\InventarisMerk;
use Illuminate\Database\Seeder;
use App\Models\InventarisBagian;
use App\Models\InventarisSatuan;
use App\Models\KasKecilTransaksi;
use App\Models\InventarisKategori;
use App\Models\RiwayatKepegawaian;
use App\Models\KasKecilMatanggaran;
use App\Models\LayananJenisKonsultasi;

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
        Marbot::factory()->count(2)->has(Keluarga::factory()->count(2))->create();
        Marbot::factory()->count(2)->has(RiwayatKepegawaian::factory()->count(2))->create();
        InventarisBagian::factory()->count(2)->create();
        InventarisKategori::factory()->count(3)->create();
        InventarisMerk::factory()->count(2)->create();
        InventarisSatuan::factory()->count(2)->create();
        LayananImam::factory()->count(2)->create();
        LayananJenisKonsultasi::factory()->count(3)->create();
        SuratAsal::factory()->count(2)->create();
        SuratKategori::factory()->count(3)->create();
        Sertifikat::factory()->count(3)->create();
        Keluarga::factory()->count(3)->create();
        RiwayatKepegawaian::factory()->count(3)->create();
        KasKecilAas::factory()->count(2)->create();
        KasKecilMatanggaran::factory()->count(2)->create();
        KasKecilTransaksi::factory()->count(2)->create();

        $this->call([
            StandardSeeder::class,
        ]);
    }
}
