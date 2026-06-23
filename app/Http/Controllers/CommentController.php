<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Project $project, Task $task)
    {
        $this->authorize('create', [Comment::class, $task]);

        $validated = $request->validate([
            'cuerpo' => 'required|string|max:1000'
        ]);

        $task->comments()->create([
            'cuerpo' => $validated['cuerpo'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('projects.tasks.index', $project)
                        ->with('success', 'Comentario publicado.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $project = $comment->task->project;
        $comment->delete();
        
        return redirect()->route('projects.tasks.index', $project)
                        ->with('success', 'Comentario eliminado.');
    }
}