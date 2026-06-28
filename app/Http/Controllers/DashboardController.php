<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $proyectosRecientes = Project::forUser($user)
                                     ->latest()
                                     ->take(5)
                                     ->get();

        $tareasRecientes = $user->tasks()
                                ->where('estado', '!=', 'completada')
                                ->latest()
                                ->take(3)
                                ->get();

        $totalProyectos = $user->hasRole(['admin', 'líder']) ? Project::count() : $user->projects()->count();
        $totalTareas = $user->tasks()->count();
        $totalUsuarios = User::count();
        $totalComentarios = Comment::count();

        return view('dashboard', compact(
            'proyectosRecientes', 
            'tareasRecientes', 
            'totalProyectos', 
            'totalTareas', 
            'totalUsuarios', 
            'totalComentarios'
        ));
    }
}