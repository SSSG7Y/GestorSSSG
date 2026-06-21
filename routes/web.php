<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    DashboardController,
    ProjectController,
    TaskController,
    MemberController,
    AdminUserController,
    CommentController
};

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);

    Route::patch('tasks/{task}/status', [TaskController::class, 'status'])->name('tasks.status');
    Route::post('tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('projects/{project}/members', [MemberController::class, 'store'])->name('members.store');
    Route::delete('projects/{project}/members/{user}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('users/{user}/roles', [AdminUserController::class, 'assignRole'])->name('admin.users.assignRole');
    });
});

require __DIR__.'/auth.php';