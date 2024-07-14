<?php

namespace Database\Factories;

use App\Models\KursusJadwal;
use App\Models\KursusMurid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusAbsensi>
 */
class KursusAbsensiFactory extends Factory
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
            'status_kehadiran' => $this->faker->randomElement(['hadir', 'tidak hadir']),
        ];
    }
}
