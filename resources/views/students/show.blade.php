@extends('layouts.app')
@section('title', 'Student Details')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Student Details</h2>
            <p class="text-muted mb-0">View student information.</p>
        </div>
        <div>
            <a href="{{ route('students.index') }}" class="btn btn-secondary me-2">Back</a>
            <a href="{{ route('students.edit', $student) }}" class="btn school-primary">Edit</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="text-muted mb-1">Student Number</p>
                    <h5>{{ $student->student_number }}</h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Name</p>
                    <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Gender</p>
                    <h5>{{ $student->gender ?? 'Not provided' }}</h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Date of Birth</p>
                    <h5>{{ $student->date_of_birth ? $student->date_of_birth->format('d M Y') : 'Not provided' }}</h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Phone</p>
                    <h5>{{ $student->phone_no ?? 'Not provided' }}</h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Email</p>
                    <h5>{{ $student->email ?? 'Not provided' }}</h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Status</p>
                    <h5>
                        @if($student->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </h5>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-1">Address</p>
                    <h5>{{ $student->address ?? 'Not provided' }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
