<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusMurid>
 */
class KursusMuridFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'alamat' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'nomor_telepon' => $this->faker->phoneNumber,
            'tanggal_daftar' => $this->faker->date,
        ];
    }
}
