<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuti>
 */
class CutiFactory extends Factory
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

            'id_karyawan' => (mt_rand(1, 10)),
            'lamacuti' => $this->faker->bothify('##-Hari'),
            'awalcuti' => $this->faker->bothify('##-Hari'),
            'kategori_cuti' => 'Cuti Karyawan',
            'alasan_cuti' => $this->faker->paragraph(),
            'pengganti' => $this->faker->bothify('##-Hari'),
            'status_cuti' => 'menunggu konfirmasi'
        ];
    }
}
