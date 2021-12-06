<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        // users
        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
        // super admin
        Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web'
        ]);
    }
}
