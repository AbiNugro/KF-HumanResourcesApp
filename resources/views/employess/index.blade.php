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
                    <h3>Employee</h3>
                    <p class="text-subtitle text-muted">
                        Handle employee tasks
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
                                Index
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Simple Datatable</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <a href="{{ route('employess.create') }}" class="btn btn-primary mb-3 ms-auto">New Task</a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($employess as $employee)

                            <tr>
                                <td>{{ $employee->fullname }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->department->description }}</td>
                                <td>{{ $employee->role->title }}</td>
                                <td>
                                    @if($employee->status == 'active')
                                        <span class="badge bg-info">Active</span>
                                   @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $employee->salary }}</td>
                                <td>
                                   <a href="{{ route('employess.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                                   <a href="{{ route('employess.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                    <form action="{{ route('employess.destroy', $employee->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sure?')">Delete</button>
                                    </form>

                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
