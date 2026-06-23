<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::inRandomOrder()->first()->id,
            'assignee_id' => User::inRandomOrder()->first()->id,
            'titulo' => fake()->sentence(),
            'descripcion' => fake()->paragraph(),
            'estado' => fake()->randomElement([
                'pendiente',
                'en_progreso',
                'completada'
            ]),
            'prioridad' => fake()->randomElement([
                'baja',
                'media',
                'alta'
            ]),
            'due_date' => fake()->date(),
        ];
    }
}