<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class TaskController extends BaseController
{
    use AuthorizesRequests;

    public function store(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project->tasks()->create($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Tarea creada');
    }

    public function status(Task $task)
    {
        $this->authorize('update', $task->project);
        
        $task->update(['is_completed' => !$task->is_completed]);

        return back()->with('success', 'Estado actualizado');
    }
}