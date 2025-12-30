<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Employee;

class LeaveRequestController extends Controller
{
    public function index() {
        if(session('role') == 'HR') {
            $leaveRequests = LeaveRequest::all();
        } else {
            $leaveRequests = LeaveRequest::where('employee_id', session('employee_id'))->get();
        }

        return view('leave-requests.index', compact('leaveRequests'));
    }

    public function create() {
        $employess = Employee::all();

        return view('leave-requests.create', compact('employess'));
    }

    public function store(Request $request) {
        if(session('role') == 'HR') {
            $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]); 

        $request->merge([
            'status' => 'pending'
        ]);

        LeaveRequest::create($request->all());
        } else {
            LeaveRequest::create([
                'employee_id' => session('employee_id'),
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'pending'
            ]);
        }

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request successfully created');
    }

    public function edit(LeaveRequest $leaveRequest) {
        $employess = Employee::all();

        return view('leave-requests.edit', compact('employess', 'leaveRequest'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest) {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]); 

        $leaveRequest->update($request->all());

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request successfully updated');
    }

    public function confirm($id) {
        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->update([
            'status' => 'confirm'
        ]);

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request successfully approved');
    }

    public function reject($id) {
        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->update([
            'status' => 'rejected'
        ]);

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request successfully rejected');
    }

    public function destroy(LeaveRequest $leaveRequest) {
        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request successfully deleted');
    }
}
