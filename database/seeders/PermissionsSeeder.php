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
        Permission::create(['name' => 'show teacher']);
        Permission::create(['name' => 'manage teacher']);
        Permission::create(['name' => 'manage course']);
        Permission::create(['name' => 'manage setting']);//
        Permission::create(['name' => 'manage faculty']);
        Permission::create(['name' => 'manage room']);
        Permission::create(['name' => 'show schedule']);//
        Permission::create(['name' => 'manage schedule']);//
        Permission::create(['name' => 'show user']);//
        Permission::create(['name' => 'manage user']);//
        Permission::create(['name' => 'manage teacher status']);
        Permission::create(['name' => 'manage teacher grade']);
        Permission::create(['name' => 'manage schedule status']);
        Permission::create(['name' => 'manage department']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Admin']);
        $role1->syncPermissions(Permission::all());
        $role1->revokePermissionTo('manage setting');
        $role1->revokePermissionTo('show schedule');
        $role1->revokePermissionTo('manage schedule');
        $role1->revokePermissionTo('show user');
        $role1->revokePermissionTo('manage user');

        $role2 = Role::create(['name' => 'Super Admin']);
        $role2->syncPermissions(Permission::all());

        $role2 = Role::create(['name' => 'Invite']);
        $role2->syncPermissions(Permission::all());
        $role1->revokePermissionTo('manage setting');
        $role1->revokePermissionTo('manage teacher');
        // $role1->revokePermissionTo('show schedule');
        $role1->revokePermissionTo('manage schedule');
        // $role1->revokePermissionTo('show user');
        $role1->revokePermissionTo('manage user');
	}

}
