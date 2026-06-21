<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->users()->where('user_id', $user->id)->exists();
    }

    public function update(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || $project->user_id === $user->id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->hasRole('admin');
    }
}