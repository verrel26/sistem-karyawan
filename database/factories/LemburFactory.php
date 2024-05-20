<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lembur>
 */
class LemburFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'niy' => (mt_rand(1, 10)),
            'id_karyawan' => (mt_rand(1, 3)),
            'nama_karyawan' => fake()->name(),
            'uraian_tugas' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($p) => "<p>$p</p>")
                ->implode(''),
            'mulai' => date('Y_m_d'),
            'selesai' => date('Y_m_d'),
            'uraian_tugas' => $this->faker->paragraph(mt_rand(5, 10)),
            'ket' => $this->faker->paragraph(mt_rand(5, 10))
        ];
    }
}
