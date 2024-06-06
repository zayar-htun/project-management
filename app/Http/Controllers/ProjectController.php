<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'department' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required'
        ]);

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function show($id)
    {
        return Project::findOrFail($id);
    }

    public function update(Request $request)
    {
        $project = Project::findOrFail($request->id);
        $project->update($request->all());

        return response()->json($project);
    }

    public function destroy(Request $request)
    {
        $project = Project::findOrFail($request->id);
        $project->delete();

        return response()->json(null, 204);
    }
}
