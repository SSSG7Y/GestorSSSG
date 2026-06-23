<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Observers\ActivityObserver;
use App\Models\Project;
use App\Models\Task;

use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        // Si necesitas registrar enlaces de servicios (bindings), hazlo aquí.
    }

    
    public function boot(): void
    {
        Project::observe(ActivityObserver::class);
        Task::observe(ActivityObserver::class);
    }
}