<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::latest()->paginate(10);

        return view ('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // course_code
        // course_name
        // duration
        // status
        // description
        $validatedData=$request->validate([
            'course_code'=>['required', 'string','max:50','unique:courses,course_code'],
            'course_name'=>['required', 'string','max:255'],
            'duration'=>['nullable','string','max:100'],
            'status'=>['required','in:active, inactive'],
            'description'=>['nullable','string'],
        ]);
        Course::create($validatedData);
        return redirect()->route('courses.index')->with('success','course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
      $validatedData=$request->validate([
     'course_code'=>['required','string','max:50','unique:courses,course_code,'.$course->id],
     'course_name'=>['required','string','max:255'],
     'duration'=>['nullable','string','max:100'],
     'status'=>['required','in:active, inactive'],
     'description'=>['nullable','string'],
    ]);  
    
   
  $course->update($validatedData);
  return redirect()->route('courses.index')->with('success', 'course updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
         return redirect()->route('courses.index')->with('success', 'course deleted successfully');
    }
}

