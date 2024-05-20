<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
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
            'nama_karyawan' => fake()->name(),
            'alamat' => fake()->address(),
            'nohp' => (mt_rand(1, 12)),
            'email' => fake()->unique()->safeEmail()
        ];
    }
}
