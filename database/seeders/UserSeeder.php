<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Dicky Surya Dinata',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        $user->assignRole('admin');

        // $user = User::where('email', 'admin@gmail.com')->first();
        // $role = Role::where('name', 'admin')->first();
        // $role = Role::create([
        //     'name' => 'admin',
        //     'guard_name' => 'web'
        // ]);

        // $user->assignRole($role);
        User::factory(10)->create();
    }
}
