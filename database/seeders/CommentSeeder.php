<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $task = Task::first();

        User::all()->each(function ($user) use ($task) {

            Comment::create([

                'task_id' => $task->id,

                'user_id' => $user->id,

                'cuerpo' => 'Comentario de prueba realizado por ' . $user->name,

            ]);

        });
    }
}