<?php

namespace Database\Factories;

use App\Models\KasKecilTransaksi;
use App\Models\KasKecilMatanggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KasKecilTransaksi>
 */
class KasKecilTransaksiFactory extends Factory
{
    protected $model = KasKecilTransaksi::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'perincian' => $this->faker->sentence(),
            'jumlah' => $this->faker->numberBetween(0, 1000000),
            'kategori' => $this->faker->randomElement(['pembentukan', 'pengeluaran', 'pengisian']),
            'tgl_transaksi' => now(),
            'matanggaran_id' => KasKecilMatanggaran::inRandomOrder()->first()->id,
            'foto_kaskecil' => "file-user/avatar.png",
        ];
    }
}
