<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KursusGuru>
 */
class KursusGuruFactory extends Factory
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
            'bidang_keahlian' => $this->faker->word,
            'pengalaman' => $this->faker->numberBetween(1, 20),
        ];
    }
}
