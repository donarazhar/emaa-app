<?php

namespace Database\Factories;

use App\Models\KursusGuru;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusKategori>
 */
class KursusKategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kursus' => $this->faker->word,
            'deskripsi' => $this->faker->paragraph,
            'durasi' => $this->faker->numberBetween(1, 12),
            'biaya' => $this->faker->randomFloat(2, 100, 1000),
            'kursus_guru_id' => KursusGuru::factory(),
        ];
    }
}
