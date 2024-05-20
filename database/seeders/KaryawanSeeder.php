<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Karyawan::create([
        //     'nama_karyawan' => 'Dicky Surya Dinata',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('12345'),
        // ]);
        Karyawan::factory(100)->create();
    }
}
