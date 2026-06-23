<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    
    public function view(User $user, Project $project): bool
    {
        if ($user->hasRole('admin')) return true;

        if ((int)$user->id === (int)$project->owner_id) return true;

        return $project->members()->where('user_id', $user->id)->exists();
    }

    
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'leader']);
    }

    public function update(User $user, Project $project): bool
    {
        if ($user->hasRole('admin')) return true;

        if ((int)$user->id === (int)$project->owner_id) return true;
        
        return $project->members()
                    ->where('user_id', $user->id)
                    ->where('project_role', 'lider')
                    ->exists();
    }

    
    public function delete(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || (int)$user->id === (int)$project->owner_id;
    }
}