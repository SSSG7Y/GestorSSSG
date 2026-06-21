<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        return $user->hasRole('admin') || $task->project->users()->where('user_id', $user->id)->exists();
    }
}