<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();

        $member = User::where('email', 'member@test.com')->first();

        $task = Task::create([

            'project_id' => $project->id,

            'assignee_id' => $member->id,

            'titulo' => 'Implementar Login',

            'descripcion' => 'Crear autenticación con Laravel Breeze',

            'estado' => 'pendiente',

            'prioridad' => 'alta',

            'due_date' => now()->addDays(7),

        ]);

        $labels = Label::pluck('id');

        $task->labels()->attach($labels);
    }
}