<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Lembur;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(PermissionsSeeder::class);
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(KaryawanSeeder::class);
        $this->call(CutiSeeder::class);
        // $this->call(LemburSeeder::class);
        // Karyawan::factory(10)->create();
        // Cuti::factory(10)->create();
    }
}
