<?php

namespace Database\Factories;

use App\Models\KursusKategori;
use App\Models\KursusMurid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusPenilaian>
 */
class KursusPenilaianFactory extends Factory
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
            'kursus_kategori_id' => KursusKategori::factory(),
            'nilai' => $this->faker->randomFloat(2, 60, 100),
            'catatan' => $this->faker->sentence,
        ];
    }
}
