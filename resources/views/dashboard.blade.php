@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Dashboard</h1>
        </div>
    </div>

    <div class="alert alert-light border-0 shadow-sm rounded-4 mb-4">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-stars fs-4 text-primary"></i>
            <div>
                <h2 class="h5 mb-0">Welcome to the Student Management System.</h2>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2">Total Students</p>
                        <h3 class="fw-bold mb-0">{{ $totalStudents }}</h3>
                    </div>
                    <div class="icon-box bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2">Total Courses</p>
                        <h3 class="fw-bold mb-0">{{ $totalCourses }}</h3>
                    </div>
                    <div class="icon-box bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-book-half fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2">Fees Collected</p>
                        <h3 class="fw-bold mb-0">KES {{ number_format($feesCollected) }}</h3>
                    </div>
                    <div class="icon-box bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-2">Outstanding Fees</p>
                        <h3 class="fw-bold mb-0">KES {{ number_format($outstandingFees) }}</h3>
                    </div>
                    <div class="icon-box bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-credit-card-2-front fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
