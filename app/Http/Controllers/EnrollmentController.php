<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'semester_id' => ['required', 'exists:semesters,id'],
            'academic_year__id' => ['required', 'exists:academic_years,id'],
        ]);

        $validated['academic_year__id'] = $request->input('academic_year__id');

        $exists = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('semester_id', $validated['semester_id'])
            ->where('academic_year__id', $validated['academic_year__id'])
            ->when($request->route('enrollment') !== null, function ($query) use ($request) {
                $query->whereKeyNot($request->route('enrollment')->id);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'student_id' => 'This student is already enrolled in this course for the selected semester and academic year.',
            ])->withInput();
        }

        Enrollment::create($validated);

        return redirect()->route('enrollment')->with('success', 'Student enrolled successfully.');
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'academic_year__id' => ['required', 'exists:academic_years,id'],
        ]);

        $exists = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('semester_id', $validated['semester_id'])
            ->where('academic_year__id', $validated['academic_year__id'])
            ->whereKeyNot($enrollment->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'student_id' => 'This student is already enrolled in this course for the selected semester and academic year.',
            ])->withInput();
        }

        $enrollment->update($validated);

        return redirect()->route('enrollment')->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollment')->with('success', 'Enrollment deleted successfully.');
    }
}
