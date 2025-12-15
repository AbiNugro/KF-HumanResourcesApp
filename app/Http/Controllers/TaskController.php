<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return view('task.index', compact('tasks'));
    }    

    public function create() {

        $employess = Employee::all();

        return view('task.create', compact('employess'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|string'
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }
}
