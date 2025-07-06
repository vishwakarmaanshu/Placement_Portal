<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Enrollment;




class EnrollmentController extends Controller
{
    // public function index()
    // {
    //     $enrollments = CourseEnrollment::with('user')->get();
    //     return view('enrollments.index', compact('enrollments'));
    // }

    public function index()
{
    $enrollments = \App\Models\CourseEnrollment::with('user')->get();
    return view('enrollments.index', compact('enrollments'));
}

public function store(Request $request)
    {
        $userId = auth()->id();
        $courseId = $request->input('course_id');

        if (!$courseId) {
            return response()->json(['status' => 'error', 'message' => 'Course ID not provided'], 400);
        }

        $exists = CourseEnrollment::where('user_id', $userId)
                    ->where('course_id', $courseId)
                    ->exists();

        if ($exists) {
            return response()->json(['status' => 'error', 'message' => 'Already enrolled'], 409);
        }

        CourseEnrollment::create([
            'user_id' => $userId,
            'course_id' => $courseId
        ]);

        return response()->json(['status' => 'success']);
    }

}
