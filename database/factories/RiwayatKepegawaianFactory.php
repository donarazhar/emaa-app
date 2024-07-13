<?php

namespace Database\Factories;

use App\Enums\RiwayatKepegawaian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiwayatKepegawaian>
 */
class RiwayatKepegawaianFactory extends Factory
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
            'foto' => 'file-user/no-image.png',
            'jabatan' => $this->faker->word(1),
            'golongan' => $this->faker->word(1),
            'keterangan' => $this->faker->word(3),
            'tipe_hubungan' => $this->faker->randomElement(RiwayatKepegawaian::getValues()),
        ];
    }
}
