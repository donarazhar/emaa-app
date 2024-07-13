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
        $kategori = $this->faker->randomElement(['debit', 'kredit']);
        $tgl_transaksi = $this->faker->dateTimeThisMonth();

        // Ambil random ID dari kas_kecil_matanggaran
        $matanggaran_id = KasKecilMatanggaran::inRandomOrder()->first()->id;

        return [
            'perincian' => $this->faker->sentence(),
            'jumlah' => $this->faker->numberBetween(0, 1000000),
            'kategori' => null,
            'tgl_transaksi' => now(),
            'matanggaran_id' => $matanggaran_id,
        ];
    }
}
