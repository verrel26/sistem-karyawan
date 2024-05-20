<?php

namespace Database\Seeders;

use App\Models\Lembur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LemburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Lembur::factory(100)->create();
    }
}
