<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Customer']);

        Permission::create(['name' => 'admin.login'])->assignRole($role1);
        Permission::create(['name' => 'admin.dashboard'])->assignRole($role1);
        Permission::create(['name' => 'admin.orders.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.orders.detail'])->assignRole($role1);

    }
}
