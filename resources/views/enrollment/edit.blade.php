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
                        <select name="semester_id" class="form-select @error('semester_id') is-invalid @enderror">
                            <option value="">Select Semester</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ old('semester_id', $enrollment->semester_id) == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('semester_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Academic Year</label>
                        <select name="academic_year__id" class="form-select @error('academic_year__id') is-invalid @enderror">
                            <option value="">Select Academic Year</option>
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ old('academic_year__id', $enrollment->academic_year__id) == $year->id ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_year__id')
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
