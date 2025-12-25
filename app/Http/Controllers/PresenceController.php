<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Employee;

class PresenceController extends Controller
{
    public function index() {
        $presences = Presence::all();

        return view('presences.index', compact('presences'));
    }

    public function create() {
        $employess = Employee::all();

        return view('presences.create', compact('employess'));
    }

    public function store(Request $request) {
        $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required|string'
        ]);

        Presence::create($request->all());

        return redirect()->route('presences.index')->with('success', 'Success presented');
    }

    public function edit(Presence $presence) {
        $employess = Employee::all();

        return view('presences.edit', compact('presence', 'employess'));
    }

    public function update(Request $request, Presence $presence) {
        $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required|string'
        ]);

        $presence->update($request->all());

        return redirect()->route('presences.index')->with('success', 'Present successfully updated');
    }

    public function destroy(Presence $presence) {
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Present successfully deleted');
    }


}
