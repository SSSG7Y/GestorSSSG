<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'task_id' => Task::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'cuerpo' => fake()->paragraph(),
        ];
    }
}