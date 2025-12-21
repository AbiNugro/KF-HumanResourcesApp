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
                        Detail employee tasks
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Task
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
                    <h5 class="card-title">Detail Task</h5>
                </div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label><b>Title</b></label>
                        <p>{{ $task->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label><b>Employee</b></label>
                        <p>{{ $task->employee->fullname }}</p>
                    </div>

                    <div class="mb-3">
                        <label><b>Employee</b></label>
                        <p>{{ $task->employee->fullname }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label><b>Due Date</b></label>
                        <p>{{ \Carbon\Carbon::parse($task->due_date)->format('d F Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label><b>Description</b></label>
                        <p>{{ $task->description }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="d-block"><b>Status</b></label>
                        @if($task->status == 'pending')
                            <p class="badge bg-warning">{{ ucfirst($task->status) }}</p>
                        @elseif($task->status == 'progress')
                            <p class="badge bg-primary">{{ ucfirst($task->status) }}</p>
                        @else
                            <p class="badge bg-success">{{ ucfirst($task->status) }}</p>
                        @endif
                    </div>

                    

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </section>
    </div>
@endsection
