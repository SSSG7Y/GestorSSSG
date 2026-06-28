<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
class TaskController extends BaseController
{
    use AuthorizesRequests;

    public function index(Request $request, Project $project)
    {
        $this->authorize('view', $project);

        $tasks = $project->tasks()
            ->with(['user', 'comments.user'])
            ->filter($request->only('search', 'estado', 'prioridad')) 
            ->orderByRaw("CASE prioridad WHEN 'alta' THEN 1 WHEN 'media' THEN 2 ELSE 3 END")
            ->orderBy('due_date', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', compact('project', 'tasks'));
    }
    public function show(Project $project, Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.index', compact('project', 'task'));

    }

    public function create(Project $project)
    {
        $this->authorize('create', [Task::class, $project]);
        return view('tasks.create', compact('project'));
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);
        
        $task = new Task($request->validated());
        $task->project_id = $project->id;
        $task->user_id = Auth::id(); 
        $task->save();
        
        return redirect()->route('projects.tasks.index', $project)
                            ->with('success', 'Tarea creada correctamente.');
    }

    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
        
        return redirect()->route('projects.tasks.index', $project)
                            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete(); 
        
        return redirect()->route('projects.tasks.index', $project)
                            ->with('success', 'Tarea eliminada correctamente.');
    }

    public function status(Project $project, Task $task)
    {
        $this->authorize('update', $task);
        
        $nuevoEstado = match ($task->estado) {
            'pendiente' => 'en_progreso',
            'en_progreso' => 'completada',
            default => 'pendiente',
        };
        
        $task->update(['estado' => $nuevoEstado]);
        
        return back()->with('success', 'Estado de tarea actualizado.');
    }

    public function assignForm(Project $project, Task $task)
    {
        $this->authorize('assign', $task);
        return view('tasks.assign', compact('project', 'task'));
    }

    public function assignUpdate(Request $request, Project $project, Task $task)
    {
        $this->authorize('assign', $task);

        $request->validate(['user_id' => 'required|exists:users,id']);

        $task->update(['assignee_id' => $request->user_id]);
        
        return redirect()->route('projects.tasks.index', $project)
                            ->with('success', 'Tarea asignada correctamente.');
    }
}