<?php

namespace Database\Factories;

use App\Models\SuratAsal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratAsal>
 */
class SuratAsalFactory extends Factory
{

    protected $model = SuratAsal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_asal_surat' => $this->faker->sentence(2),
            'keterangan_asal_surat' => $this->faker->sentence,
        ];
    }
}
