@extends('layouts.app')
@section('title', 'Edit Enrollment')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Edit Enrollment</h2>
        <p class="text-muted">Update the selected student enrollment.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('enrollment.update', $enrollment) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Student</label>
                        <select name="student_id" class="form-select @error('student_id') is-invalid @enderror">
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Course</label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }} ({{ $course->course_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Semester</label>
                        <input type="text" name="semester" value="{{ old('semester', $enrollment->semester->name) }}" class="form-control @error('semester') is-invalid @enderror">
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Academic Year</label>
                        <input type="text" name="academic_year" value="{{ old('academic_year', $enrollment->academicYear->name) }}" class="form-control @error('academic_year') is-invalid @enderror">
                        @error('academic_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('enrollment') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn school-primary">
                        <i class="bi bi-check-lg me-1"></i>
                        Update Enrollment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
