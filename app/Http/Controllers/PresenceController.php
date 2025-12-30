<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Employee;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function index() {
        if(session('role') == 'HR') {
            $presences = Presence::all();
        } else {
            $presences = Presence::where('employee_id', session('employee_id'))->get();
        }

        return view('presences.index', compact('presences'));
    }

    public function create() {
        $employess = Employee::all();

        return view('presences.create', compact('employess'));
    }

    public function store(Request $request) {
        if(session('role') == 'HR') {
            $request->validate([
            'employee_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required|string'
        ]);

        Presence::create($request->all());
        } else {
            Presence::create([
                'employee_id' => session('employee_id'),
                'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => 'present'
            ]);
        }
        

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
