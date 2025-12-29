@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Leave Request</h3>
                    <p class="text-subtitle text-muted">
                        Handle leave request data
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Leave Request
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Leave Request Data</h5>
                </div>
                <div class="card-body">
                    
        
                    <form action="{{ route('leave-requests.update', $leaveRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="">Select an employee</option>
                                @foreach ($employess as $employee)
                                <option value="{{ $employee->id }}" {{ ($employee->id == $leaveRequest->employee_id) ? 'selected' : '' }}>{{ ucfirst($employee->fullname) }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Leave Type</label>
                            <select name="leave_type" id="leave_type" class="form-control @error('leave_type') is-invalid @enderror">
                                <option value="">Select an leave type</option>
                                <option value="Sick Leave" {{ $leaveRequest->leave_type == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="Annual Leave" {{ $leaveRequest->leave_type == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                                <option value="Personal Leave" {{ $leaveRequest->leave_type == 'Personal Leave' ? 'selected' : '' }}>Personal Leave</option>
                                <option value="Emergency Leave" {{ $leaveRequest->leave_type == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                                <option value="Unpaid Leave" {{ $leaveRequest->leave_type == 'Unpaid Leave' ? 'selected' : '' }}>Unpaid Leave</option>
                                
                            </select>    
                            @error('leave_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Start Date</label>
                            <input type="date" class="form-control date_flatpicker" name="start_date" value="{{ old('start_date', $leaveRequest->start_date) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">End Date</label>
                            <input type="date" class="form-control date_flatpicker" name="end_date" value="{{ old('end_date', $leaveRequest->end_date) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary">Back to List</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
