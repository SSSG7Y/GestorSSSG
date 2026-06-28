<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class TaskPolicy
{
    private function isAdminOrOwner(User $user, Project $project): bool
    {
        return $user->hasRole('admin') || (int)$user->id === (int)$project->owner_id;
    }

    private function isLeader(User $user, Project $project): bool
    {
        return $project->members()->where('user_id', $user->id)->where('project_role', 'lider')->exists();
    }

    public function create(User $user, $project): bool
    {
        return $this->isAdminOrOwner($user, $project) || $this->isLeader($user, $project);
    }

    public function update(User $user, Task $task): bool
    {
        return $this->isAdminOrOwner($user, $task->project) || 
               $this->isLeader($user, $task->project) || 
               (int)$user->id === (int)$task->assignee_id;
    }

    public function delete(User $user, Task $task): bool
    {
        if ($user->hasRole('invitado')) return false;
        return $this->isAdminOrOwner($user, $task->project) || $this->isLeader($user, $task->project);
    }

    public function assign(User $user, Task $task): bool
    {
        return $this->isAdminOrOwner($user, $task->project) || $this->isLeader($user, $task->project);
    }
}