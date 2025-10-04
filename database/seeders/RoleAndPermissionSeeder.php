<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'verified form']);
        Permission::create(['name' => 'unverified form']);
        Permission::create(['name' => 'edit data']);
        Permission::create(['name' => 'update data']);
        Permission::create(['name' => 'input data']);
        Permission::create(['name' => 'delete data']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['input data', 'update data']);

        $role = Role::create(['name' => 'verifier']);
        $role->givePermissionTo(['verified form', 'unverified form', 'edit data', 'update data', 'delete data']);

        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());
    }
}
