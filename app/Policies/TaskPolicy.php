<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class TaskPolicy
{
    private function canManageProject(User $user, Project $project): bool
    {
        if ($user->hasRole('admin')) return true;
        if ((int)$user->id === (int)$project->owner_id) return true;
        
        return $project->members()->where('user_id', $user->id)->exists();
    }

    public function create(User $user, Project $project): bool
    {
        return $this->canManageProject($user, $project);
    }

    public function update(User $user, Task $task): bool
    {
        return $this->canManageProject($user, $task->project);
    }

    public function delete(User $user, Task $task): bool
    {
        if ($user->hasRole('guest')) return false;
        return $this->canManageProject($user, $task->project);
    }
}