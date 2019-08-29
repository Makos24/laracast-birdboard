<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }
    
    public function store()
    {
        auth()->user()->projects()->create(request()
            ->validate(['title' => 'required', 'description' => 'required']));

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)){
            return abort(403);
        }
        return view('projects.show', compact('project'));
    }

    public function update(Project $project)
    {
        if (auth()->user()->isNot($project->owner)){
            return abort(403);
        }
        $project->update(request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable|max:255']));
        return redirect($project->path());
    }

    
}
