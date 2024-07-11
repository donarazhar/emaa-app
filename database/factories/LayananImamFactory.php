<?php

namespace Database\Factories;

use App\Models\LayananImam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LayananImam>
 */
class LayananImamFactory extends Factory
{
    protected $model = LayananImam::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_imam' => $this->faker->name,
            'nohp_imam' => $this->faker->phoneNumber,
            'keterangan' => $this->faker->sentence,
        ];
    }
}
