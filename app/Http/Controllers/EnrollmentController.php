<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course', 'semester', 'academicYear'])
            ->latest()
            ->paginate(10);

        $students = Student::orderBy('first_name')->get();
        $courses = Course::orderBy('course_name')->get();
        $semesters = Semester::orderBy('id')->get();
        $academicYears = AcademicYear::orderBy('name')->get();

        return view('enrollment.index', compact(
            'enrollments',
            'students',
            'courses',
            'semesters',
            'academicYears'
        ));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::orderBy('first_name')->get();
        $courses = Course::orderBy('course_name')->get();
        $semesters = Semester::orderBy('id')->get();
        $academicYears = AcademicYear::orderBy('name')->get();

        return view('enrollment.edit', compact(
            'enrollment',
            'students',
            'courses',
            'semesters',
            'academicYears'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'semester' => ['required', 'string', 'max:255'],
            'academic_year' => ['required', 'string', 'max:255'],
        ]);

        $semester = Semester::where('name', $validated['semester'])->first();
        $academicYear = AcademicYear::where('name', $validated['academic_year'])->first();

        if ($semester && $academicYear && Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('semester_id', $semester->id)
            ->where('academic_year_id', $academicYear->id)
            ->exists()) {
            return back()->withErrors([
                'student_id' => 'This student is already enrolled in this course for the selected semester and academic year.',
            ])->withInput();
        }

        $semester = Semester::firstOrCreate(['name' => $validated['semester']]);
        $academicYear = AcademicYear::firstOrCreate(['name' => $validated['academic_year']]);

        Enrollment::create([
            'student_id' => $validated['student_id'],
            'course_id' => $validated['course_id'],
            'semester_id' => $semester->id,
            'academic_year_id' => $academicYear->id,
        ]);

        return redirect()->route('enrollment')->with('success', 'Student enrolled successfully.');
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'semester' => ['required', 'string', 'max:255'],
            'academic_year' => ['required', 'string', 'max:255'],
        ]);

        $semester = Semester::where('name', $validated['semester'])->first();
        $academicYear = AcademicYear::where('name', $validated['academic_year'])->first();

        $duplicate = $semester && $academicYear && Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('semester_id', $semester->id)
            ->where('academic_year_id', $academicYear->id)
            ->where('id', '!=', $enrollment->id)
            ->exists();

        if ($duplicate) {
            return back()->withErrors([
                'student_id' => 'This student is already enrolled in this course for the selected semester and academic year.',
            ])->withInput();
        }

        $semester = Semester::firstOrCreate(['name' => $validated['semester']]);
        $academicYear = AcademicYear::firstOrCreate(['name' => $validated['academic_year']]);

        $enrollment->update([
            'student_id' => $validated['student_id'],
            'course_id' => $validated['course_id'],
            'semester_id' => $semester->id,
            'academic_year_id' => $academicYear->id,
        ]);

        return redirect()->route('enrollment')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollment')->with('success', 'Enrollment deleted successfully.');
    }
}
