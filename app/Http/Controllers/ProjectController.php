<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class ProjectController extends BaseController
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();
        
        // El scope ForUser maneja automáticamente la lógica de Admin, Leader o Miembro
        $projects = Project::forUser($user)->latest()->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('create', Project::class);
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $project = new Project($request->validated());
        $project->owner_id = Auth::id();
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente.');
    }

    public function show(Project $project)
    {
        $activities = \App\Models\Activity::where('project_id', $project->id)
                                        ->latest()
                                        ->limit(10)
                                        ->get();
        return view('projects.show', compact('project', 'activities'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());
        
        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente.');
    }
}