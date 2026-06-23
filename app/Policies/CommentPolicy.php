<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Models\Task;

class CommentPolicy
{
    public function create(User $user, Task $task): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        if ((int)$user->id === (int)$task->project->owner_id) {
            return true;
        }

        return $task->project->members()->where('user_id', $user->id)->exists();
    }

    public function delete(User $user, Comment $comment): bool
    {
        if ($user->hasRole('admin') || (int)$user->id === (int)$comment->task->project->owner_id) {
            return true;
        }

        $esLider = $comment->task->project->members()
            ->where('user_id', $user->id)
            ->where('project_role', 'lider')
            ->exists();

        if ($esLider) return true;

        return (int)$user->id === (int)$comment->user_id;
    }
}