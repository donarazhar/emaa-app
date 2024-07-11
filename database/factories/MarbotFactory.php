<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marbot>
 */
class MarbotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->randomNumber(8, true),
            'nama' => $this->faker->name(),
            'tlahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->dateTimeThisCentury()->format('Y-m-d'),
            'jenkel' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'goldar' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'status_nikah' => $this->faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai']),
            'status_pegawai' => $this->faker->randomElement(['KTD', 'Capeg', 'Kontrak']),
            'alamat' => $this->faker->address(),
            'standard_id' => 1,


        ];
    }
}
