<?php

namespace Database\Factories;

use App\Models\InventarisBagian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventaisBagian>
 */
class InventarisBagianFactory extends Factory
{
    protected $model = InventarisBagian::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_bagian' => $this->faker->randomElement(['Ruang Utama', 'Ruang Kantor', 'Gudang Marbot', 'Gudang Teknisi']),
            'keterangan_bagian' => $this->faker->sentence,
        ];
    }
}
