<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Placement;

class HomeController extends Controller
{
    // Homepage
    // public function home()
    // {
    //     $courses = Course::paginate(6);  // ✅ Use paginate
    //     $placements = Placement::all();  // All placement cards

    //     return view('home', compact('courses', 'placements'));
    // }

    // Show user dashboard courses (like after login)
    // public function showCourses()
    // {
    //     $courses = Course::paginate(6);
    //     return view('user.courses', compact('courses'));
    // }

    public function index()
    {
        // Paginate 3 courses per page, named page key: courses_page
        $courses = Course::paginate(3, ['*'], 'courses_page');

        // Paginate 3 placements per page, named page key: placements_page
        $placements = Placement::with('user', 'course')->paginate(3, ['*'], 'placements_page');
        

        return view('home', compact('courses', 'placements'));
    }

    public function home()
{
    return $this->index(); // Just reuse the index method
}

public function showCourses()
{
    $courses = Course::paginate(3); // or your custom query
    return view('user.courses', compact('courses'));
}

}
