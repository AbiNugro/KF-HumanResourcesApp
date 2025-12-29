<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\Employee;

class LeaveRequestController extends Controller
{
    public function index() {
        $leaveRequests = LeaveRequest::all();

        return view('leave-requests.index', compact('leaveRequests'));
    }

    public function create() {
        $employess = Employee::all();

        return view('leave-requests.create', compact('employess'));
    }

    public function store(Request $request) {
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
