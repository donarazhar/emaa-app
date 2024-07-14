<?php

namespace Database\Factories;

use App\Models\KursusJadwal;
use App\Models\KursusMurid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusPendaftaran>
 */
class KursusPendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kursus_murid_id' => KursusMurid::factory(),
            'kursus_jadwal_id' => KursusJadwal::factory(),
            'tanggal_pendaftaran' => $this->faker->date,
            'status' => 'aktif',
        ];
    }
}
