<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KasKecilAas>
 */
class KasKecilAasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_aas' => $this->faker->unique()->word(1),
            'nama_aas' => $this->faker->name,
            'kategori' => $this->faker->randomElement(['pembentukan', 'pengisian', 'pengeluaran']),
            'status' => $this->faker->randomElement(['debit', 'kredit']),
            //
        ];
    }
}
