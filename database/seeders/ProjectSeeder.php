<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $leader = User::where('email', 'leader@test.com')->first();
        $member = User::where('email', 'member@test.com')->first();
        $guest = User::where('email', 'guest@test.com')->first();

        $project = Project::create([
            'nombre' => 'Sistema GestorSSSG',
            'descripcion' => 'Proyecto Final INF560',
            'estado' => 'activo',
            'owner_id' => $leader->id,
        ]);

        $project->members()->attach($leader->id, [
            'project_role' => 'lider'
        ]);

        $project->members()->attach($member->id, [
            'project_role' => 'colaborador'
        ]);

        $project->members()->attach($guest->id, [
            'project_role' => 'invitado'
        ]);
    }
}