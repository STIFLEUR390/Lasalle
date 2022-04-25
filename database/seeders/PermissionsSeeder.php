<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'base']);
        Permission::create(['name' => 'manage teacher']);
        Permission::create(['name' => 'manage course']);
        Permission::create(['name' => 'manage setting']);
        Permission::create(['name' => 'manage faculty']);
        Permission::create(['name' => 'manage room']);
        Permission::create(['name' => 'manage schedule']);
        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'manage attendance']);
        Permission::create(['name' => 'manage teacher status']);
        Permission::create(['name' => 'manage teacher grade']);
        Permission::create(['name' => 'manage schedule status']);
        Permission::create(['name' => 'manage department']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin']);
        $role1->givePermissionTo('manage teacher');
        $role1->givePermissionTo('manage course');
        // $role1->givePermissionTo('manage setting');
        $role1->givePermissionTo('manage faculty');
        $role1->givePermissionTo('manage room');
        $role1->givePermissionTo('manage schedule');
        $role1->givePermissionTo('manage user');
        // $role1->givePermissionTo('manage attendance');
        $role1->givePermissionTo('base');
        $role1->givePermissionTo('manage teacher status');
        $role1->givePermissionTo('manage teacher grade');
        $role1->givePermissionTo('manage schedule status');
        $role1->givePermissionTo('manage department');

        $role2 = Role::create(['name' => 'Super Admin']);
        $role2->givePermissionTo('manage teacher');
        $role2->givePermissionTo('manage course');
        $role2->givePermissionTo('manage setting');
        $role2->givePermissionTo('manage faculty');
        $role2->givePermissionTo('manage room');
        $role2->givePermissionTo('manage schedule');
        $role2->givePermissionTo('manage user');
        $role2->givePermissionTo('manage attendance');
        $role2->givePermissionTo('base');
        $role1->givePermissionTo('manage teacher status');
        $role1->givePermissionTo('manage teacher grade');
        $role1->givePermissionTo('manage schedule status');
        $role2->givePermissionTo('manage department');
	}

}
