<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            'view projects',
            'create projects',
            'edit projects',
            'delete projects',

            'manage members',

            'view tasks',
            'create tasks',
            'edit tasks',
            'assign tasks',

            'comment',

            'manage users'

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission
            ]);

        }

        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $leader = Role::firstOrCreate([
            'name' => 'leader'
        ]);

        $member = Role::firstOrCreate([
            'name' => 'member'
        ]);

        $guest = Role::firstOrCreate([
            'name' => 'guest'
        ]);

        $admin->givePermissionTo(Permission::all());

        $leader->givePermissionTo([
            'view projects',
            'create projects',
            'edit projects',
            'manage members',
            'view tasks',
            'create tasks',
            'assign tasks',
            'comment'
        ]);

        $member->givePermissionTo([
            'view projects',
            'view tasks',
            'edit tasks',
            'comment'
        ]);

        $guest->givePermissionTo([
            'view projects',
            'comment'
        ]);
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}