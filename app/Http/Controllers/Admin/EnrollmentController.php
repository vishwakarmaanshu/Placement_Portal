<?php

// app/Http/Controllers/Admin/EnrollmentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = DB::table('course_enrollments')
            ->join('users', 'course_enrollments.user_id', '=', 'users.id')
            ->join('courses', 'course_enrollments.course_id', '=', 'courses.id')
            ->select(
                'users.id as user_id',
                'users.name as student',
                'users.email',
                'courses.name as course',
                'courses.duration'
            )
            ->get();

        return view('admin.enrollments.index', compact('enrollments'));
    }
}
