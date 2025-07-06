<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class UserController extends Controller
{
    // public function dashboard()
    // {
    //     return view('user.dashboard');
    // }


public function index()
    {
        return view('user.dashboard'); // Blade file at resources/views/user/dashboard.blade.php
    }



    

public function dashboard()
{
    $courses = Course::all();

    // Optional: convert all YouTube links to embeddable format
    foreach ($courses as $course) {
        $decodedLinks = json_decode($course->youtube_link, true);
        if (is_array($decodedLinks) && count($decodedLinks) > 0) {
            $firstLink = $decodedLinks[0];

            // Embed conversion
            if (Str::contains($firstLink, 'watch?v=')) {
                $videoId = explode('watch?v=', $firstLink)[1];
                $course->embed_url = 'https://www.youtube.com/embed/' . $videoId;
            } elseif (Str::contains($firstLink, 'youtu.be/')) {
                $videoId = explode('youtu.be/', $firstLink)[1];
                $course->embed_url = 'https://www.youtube.com/embed/' . $videoId;
            } else {
                $course->embed_url = $firstLink;
            }
        } else {
            $course->embed_url = ''; // fallback if no link
        }
    }

    return view('user.dashboard', compact('courses'));
}


}
