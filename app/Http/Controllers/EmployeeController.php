<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index() {
        $employess = Employee::all();
        
        return view('employess.index', compact('employess'));
    }
}
