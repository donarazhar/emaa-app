<?php

namespace Database\Factories;

use App\Models\KursusPendaftaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusPembayaran>
 */
class KursusPembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kursus_pendaftaran_id' => KursusPendaftaran::factory(),
            'tanggal_pembayaran' => $this->faker->date,
            'jumlah' => $this->faker->randomFloat(2, 100, 1000),
            'metode_pembayaran' => $this->faker->randomElement(['transfer bank', 'kartu kredit', 'e-wallet']),
            'status' => 'lunas',
        ];
    }
}
