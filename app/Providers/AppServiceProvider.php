<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Observers\ActivityObserver;
use App\Policies\CommentPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Project::observe(ActivityObserver::class);
        Task::observe(ActivityObserver::class);

        Gate::policy(Task::class, TaskPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
        Gate::policy(Project::class, ProjectPolicy::class);

        \Illuminate\Support\Facades\View::composer('layouts.navigation', function ($view) {
            /** @var \App\Models\User|null $user */
            $user = \Illuminate\Support\Facades\Auth::user();

            if ($user) {
                $proyectosNavegacion = $user->hasRole(['admin', 'líder']) 
                    ? \App\Models\Project::all() 
                    : $user->projects;
                    
                $view->with('proyectosNavegacion', $proyectosNavegacion);
            }
        });
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}