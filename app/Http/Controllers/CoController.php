<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseEnrollment;

class CoController extends Controller
{
    public function showCourses()
{
    $courses = Course::all(); // ✅ fetch all courses
    return view('user.courses', compact('courses'));

 // ✅ send to Blade
}

    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $userId = auth()->id();
        $course = Course::find($request->course_id);
        $courseName = $course->name;

        $alreadyEnrolled = CourseEnrollment::where('user_id', $userId)
                            ->where('course_name', $courseName)
                            ->exists();

        if ($alreadyEnrolled) {
            return response()->json(['message' => 'Already enrolled']);
        }

        CourseEnrollment::create([
            'user_id' => $userId,
            'course_name' => $courseName,
        ]);

        return response()->json(['message' => 'Enrollment successful']);
    }

    
}
