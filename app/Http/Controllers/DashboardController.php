<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
class DashboardController extends Controller
{
    public function index() {
    return view('dashboard', [
            'totalProyectos' => Project::count(),
            'totalTareas' => Task::count(),
            'totalUsuarios' => User::count(),
        ]);
    }
}