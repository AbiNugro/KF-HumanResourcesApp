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
                    <h3>Task</h3>
                    <p class="text-subtitle text-muted">
                        Detail employee data and profile
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Employee
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Detail
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Detail Employee</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><b>Fullname</b></label>
                                <p>{{ $employee->fullname }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Email</b></label>
                                <p>{{ $employee->email }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Phone Number</b></label>
                                <p>{{ $employee->phone_number }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Address</b></label>
                                <p>{{ $employee->address }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Birth Date</b></label>
                                <p>{{ \Carbon\Carbon::parse($employee->birth_date)->format('d F Y') }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Hire Date</b></label>
                                <p>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><b>Department</b></label>
                                <p>{{ $employee->department->description }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Role</b></label>
                                <p>{{ $employee->role->title }}</p>
                            </div>

                            <div class="mb-3">
                                <label><b>Salar</b></label>
                                <p>{{ $employee->salary }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="d-block"><b>Status</b></label>
                                @if ($employee->status == 'active')
                                    <p class="badge bg-info">{{ ucfirst($employee->status) }}</p>
                                @else
                                    <p class="badge bg-danger">{{ ucfirst($employee->status) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('employess.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </section>
    </div>
@endsection
