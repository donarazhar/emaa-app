<?php

namespace Database\Factories;

use App\Models\KasKecilAas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KasKecilMatanggaran>
 */
class KasKecilMatanggaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'kode_matanggaran' => $this->faker->unique()->word(1),
            'aas_id' => KasKecilAas::factory()->create()->id,
            'saldo' => $this->faker->numberBetween(0, 1000000),
        ];
    }
}
