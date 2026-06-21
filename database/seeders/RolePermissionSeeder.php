<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $leader = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'leader']);
        $member = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'member']);

        $p1 = \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'create projects']);
        $p2 = \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'edit tasks']);

        $admin->givePermissionTo([$p1, $p2]);
        $leader->givePermissionTo([$p1]);
    }
}
