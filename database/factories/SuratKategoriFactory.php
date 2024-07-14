<?php

namespace Database\Factories;

use App\Models\SuratKategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratKategori>
 */
class SuratKategoriFactory extends Factory
{
    protected $model = SuratKategori::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kategori' => $this->faker->randomElement(['Surat Biasa', 'Surat Penting', 'Surat Tak Dikenal']),
            'keterangan_kategori' => $this->faker->sentence,
        ];
    }
}
