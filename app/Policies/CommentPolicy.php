<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;

class CommentPolicy
{
    public function create(User $user, $taskOrProject): bool
    {
        $project = ($taskOrProject instanceof Task) ? $taskOrProject->project : $taskOrProject;

        if ($user->hasRole('admin')) return true;
        if ((int)$user->id === (int)$project->owner_id) return true;
        
        if ($taskOrProject instanceof Task && (int)$user->id === (int)$taskOrProject->assignee_id) {
            return true;
        }

        return $project->members()->where('user_id', $user->id)->exists();
    }

    public function delete(User $user, Comment $comment): bool
    {
        $task = $comment->task;
        $project = $task->project;

        if ($user->hasRole('admin') || (int)$user->id === (int)$project->owner_id) return true;
        if ((int)$user->id === (int)$comment->user_id) return true;
        if ($task->assignee_id && (int)$user->id === (int)$task->assignee_id) return true;

        return $project->members()->where('user_id', $user->id)->where('project_role', 'lider')->exists();
    }
}