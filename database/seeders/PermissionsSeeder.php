<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listPermissions = [
            'create-roles',
            'read-roles',
            'update-roles',
            'delete-roles',
            'assign-permissions',
            'create-permissions',
            'read-permissions',
            'update-permissions',
            'delete-permissions',
        ];

        foreach ($listPermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
