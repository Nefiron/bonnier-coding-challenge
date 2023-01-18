<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('entries')->get();

        return view('projects.index', ['projects' => $projects]);
    }

    public function show(Project $project)
    {
        $showProject = Project::with(['entries' => function($q) {
            $q->orderBy('start', 'desc');
        }])->find($project->id);

        return view('projects.show', ['project' => $showProject]);
    }

    public function store(Request $request)
    {
        Project::create([
            'name' => $request->get('name')
        ]);

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $project = Project::find($request->get('id'));
        $project->name = $request->get('name');
        $project->save();

        return response()->json(['status' => 'success']);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(['message' => 'Project deleted']);
    }
}
