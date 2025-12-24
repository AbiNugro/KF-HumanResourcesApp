<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Role;

class EmployeeController extends Controller
{
    public function index() {
        $employess = Employee::all();

        return view('employess.index', compact('employess'));
    }

    public function create() {
        $departments = Department::all();
        $roles = Role::all();

        return view('employess.create', compact('departments', 'roles'));
    }

    public function store(Request $request) {
        
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required',
            'role_id' => 'required',
            'status' => 'required|string',
            'salary' => 'required|numeric'
        ]);

        Employee::create($request->all());

        return(redirect()->route('employess.index')->with('success', 'Employee created successfully'));
    }

    public function show($id) {
        $employee = Employee::findOrFail($id);

        return view('employess.show', compact('employee'));
    }

    public function edit($id) {
        $employee = Employee::find($id);
        $departments = Department::all();
        $roles = Role::all();

        return view('employess.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, $id) {

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required',
            'role_id' => 'required',
            'status' => 'required|string',
            'salary' => 'required|numeric'
        ]);

        $employee = Employee::findOrFail($id);

        $employee->update($request->all());

        return redirect()->route('employess.index')->with('success', 'Employee updated successfully');

    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect()->route('employess.index')->with('success', 'Employee deleted successfully');
    }
}
