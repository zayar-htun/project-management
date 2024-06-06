<?php

namespace App\Http\Controllers;

// app/Http/Controllers/TimesheetController.php
use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return Timesheet::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required',
            'date' => 'required|date',
            'hours' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id'
        ]);

        $timesheet = Timesheet::create($validated);

        return response()->json($timesheet, 201);
    }

    public function show($id)
    {
        return Timesheet::findOrFail($id);
    }

    public function update(Request $request)
    {
        $timesheet = Timesheet::findOrFail($request->id);
        $timesheet->update($request->all());

        return response()->json($timesheet);
    }

    public function destroy(Request $request)
    {
        $timesheet = Timesheet::findOrFail($request->id);
        $timesheet->delete();

        return response()->json(null, 204);
    }
}
