<?php

namespace Database\Factories;

use App\Models\InventarisKategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventarisKategori>
 */
class InventarisKategoriFactory extends Factory
{
    protected $model = InventarisKategori::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kategori' => $this->faker->sentence(2),
            'nama_kategori' => $this->faker->randomElement(['Barang Lambat', 'Barang Cepat']),
            'keterangan_kategori' => $this->faker->sentence,
        ];
    }
}
