<?php

namespace Database\Factories;

use App\Models\KursusKategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursuJadwal>
 */
class KursusJadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kursus_kategori_id' => KursusKategori::factory(),
            'tanggal' => $this->faker->date,
            'waktu_mulai' => $this->faker->time,
            'waktu_selesai' => $this->faker->time,
        ];
    }
}
