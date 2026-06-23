<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        $admin = User::factory()->create([

            'name' => 'Administrador',

            'email' => 'admin@test.com',

        ]);

        $admin->assignRole('admin');



        $leader = User::factory()->create([

            'name' => 'Lider',

            'email' => 'leader@test.com',

        ]);

        $leader->assignRole('leader');



        $member = User::factory()->create([

            'name' => 'Colaborador',

            'email' => 'member@test.com',

        ]);

        $member->assignRole('member');



        $guest = User::factory()->create([

            'name' => 'Invitado',

            'email' => 'guest@test.com',

        ]);

        $guest->assignRole('guest');

    }
}