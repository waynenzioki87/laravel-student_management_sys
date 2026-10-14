@extends('layouts.app')
@section('title', 'Enrollment')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Enrollment</h2>
            <p class="text-muted mb-0">Register students for courses and terms.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($students->isEmpty())
        <div class="alert alert-warning">
            Add a student before creating an enrollment.
            <a href="{{ route('students.create') }}" class="alert-link">Create a student</a>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 pt-4">
            <h5 class="mb-0">Add Enrollment</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('enrollment.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Student</label>
                        <select name="student_id" class="form-select @error('student_id') is-invalid @enderror">
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
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
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
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
                        <input type="text" name="semester" value="{{ old('semester') }}" class="form-control @error('semester') is-invalid @enderror" placeholder="e.g. Semester 1">
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Academic Year</label>
                        <input type="text" name="academic_year" value="{{ old('academic_year') }}" class="form-control @error('academic_year') is-invalid @enderror" placeholder="e.g. 2026-2027">
                        @error('academic_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn school-primary" {{ $students->isEmpty() || $courses->isEmpty() ? 'disabled' : '' }}>
                        <i class="bi bi-check-lg me-1"></i>
                        Save Enrollment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Academic Year</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->student ? $enrollment->student->first_name . ' ' . $enrollment->student->last_name : 'N/A' }}</td>
                                <td>{{ $enrollment->course ? $enrollment->course->course_name : 'N/A' }}</td>
                                <td>{{ $enrollment->semester ? $enrollment->semester->name : 'N/A' }}</td>
                                <td>{{ $enrollment->academicYear ? $enrollment->academicYear->name : 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('enrollment.edit', $enrollment) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('enrollment.destroy', $enrollment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No enrollments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
