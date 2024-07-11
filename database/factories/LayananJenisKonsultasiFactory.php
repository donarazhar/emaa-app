<?php

namespace Database\Factories;

use App\Models\LayananJenisKonsultasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LayananJenisKonsultasi>
 */
class LayananJenisKonsultasiFactory extends Factory
{

    protected $model = LayananJenisKonsultasi::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jenis_konsultasi' => $this->faker->sentence(2), // Menghasilkan kalimat dengan 3 kata
            'deskripsi' => $this->faker->sentence,
        ];
    }
}
