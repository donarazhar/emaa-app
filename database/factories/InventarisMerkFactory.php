<?php

namespace Database\Factories;

use App\Models\InventarisMerk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventarisMerk>
 */
class InventarisMerkFactory extends Factory
{
    protected $model = InventarisMerk::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_merk' => $this->faker->randomElement(['Toshiba', 'Sharp', 'Samsung']),
            'keterangan_merk' => $this->faker->sentence,
        ];
    }
}
