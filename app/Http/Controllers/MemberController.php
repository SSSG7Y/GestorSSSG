<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class MemberController extends Controller
{
    use AuthorizesRequests; 

    public function store(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string'
        ]);
        
        $project->members()->attach($request->user_id, ['project_role' => $request->role]);
        
        return back()->with('success', 'Miembro agregado correctamente.');
    }

    public function destroy(Project $project, User $user)
    {
        $this->authorize('update', $project);
        
        $project->members()->detach($user->id);
        
        return back()->with('success', 'Miembro eliminado correctamente.');
    }
}