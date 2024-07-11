<?php

namespace Database\Factories;

use App\Enums\TipeHubungan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keluarga>
 */
class KeluargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'no_kontak' => $this->faker->phoneNumber(),
            'tipe_hubungan' => $this->faker->randomElement(TipeHubungan::getValues()),
        ];
    }
}
