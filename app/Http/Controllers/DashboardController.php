<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'totalProyectos' => Project::count(),

            'totalTareas' => Task::count(),

            'totalUsuarios' => User::count(),

            'totalComentarios' => Comment::count(),

            'proyectosRecientes' => Project::latest()->take(5)->get(),

            'tareasRecientes' => Task::latest()->take(5)->get(),

        ]);
    }
}