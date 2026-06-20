<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProfileController, DashboardController, ProjectController, TaskController, MemberController, AdminUserController, CommentController};

// Landing
Route::get('/', fn () => view('welcome'))->name('home');

// Rutas Autenticadas
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Proyectos y Tareas
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);

    // Gestión de miembros
    Route::post('projects/{project}/members', [MemberController::class, 'store'])->name('members.store');
    Route::delete('projects/{project}/members/{user}', [MemberController::class, 'destroy'])->name('members.destroy');

    // Acciones específicas de tareas
    Route::patch('tasks/{task}/status', [TaskController::class, 'status'])->name('tasks.status');
    Route::patch('tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');
    Route::post('tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Área de Administración (Solo Admin)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('users/{user}/roles', [AdminUserController::class, 'assignRole'])->name('admin.users.assignRole');
    });
});

require __DIR__.'/auth.php';