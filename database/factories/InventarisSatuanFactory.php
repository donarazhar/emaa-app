<?php

namespace Database\Factories;

use App\Models\InventarisSatuan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventarisSatuan>
 */
class InventarisSatuanFactory extends Factory
{
    protected $model = InventarisSatuan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_satuan' => ucfirst($this->faker->word), // Menghasilkan satu kata dengan huruf pertama kapital
            'keterangan_satuan' => $this->faker->sentence,
        ];
    }
}
