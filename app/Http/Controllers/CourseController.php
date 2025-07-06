<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\CourseVideo;
use App\Models\CourseYoutubeVideo;



class CourseController extends Controller
{
    // Show all courses for admin
    // public function index()
    // {
    //     $courses = Course::paginate(6); // paginate to enable links()
    //     return view('admin.courses.index', compact('courses'));
    // }

// public function index()
// {
//     $courses = Course::with('videos')->get(); // ✅ Eager load videos

//     return view('admin.courses.index', compact('courses'));
// }

public function index()
{
    $courses = Course::with('youtubeVideos')->get(); // ✅ use 'with'
    return view('admin.courses.index', compact('courses'));
}




    // Show all courses for user
    // public function userCourses()
    // {
    //     $courses = Course::paginate(6);
    //     return view('user.courses', compact('courses'));
    // }

    // Show form to create new course
    public function create()
    {
        return view('admin.courses.create');
    }

    // Store new course
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'duration' => 'required|string|max:255',
        'technologies' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $course = new Course();
    $course->name = $request->name;
    $course->duration = $request->duration;
    $course->technologies = $request->technologies;

    if ($request->hasFile('image')) {
        $course->image = $request->file('image')->store('courses', 'public');
    }

    $course->save();

    return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
}

    // Save video links as JSON
    

   



    // Edit course form
    public function edit($id)
{
    $course = Course::findOrFail($id);
    return view('admin.courses.edit', compact('course'));
}


  
     // Update course
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'duration' => 'required|string|max:255',
        'technologies' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $course = Course::findOrFail($id);
    $course->name = $request->name;
    $course->duration = $request->duration;
    $course->technologies = $request->technologies;

    if ($request->hasFile('image')) {
        // Optional: delete old image
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->image = $request->file('image')->store('courses', 'public');
    }

    $course->save();

    return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
}


    // Delete course
    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }

    // Enroll user in a course
    // public function enroll(Request $request)
    // {
    //     $request->validate([
    //         'course_id' => 'required|exists:courses,id',
    //     ]);

    //     $userId = auth()->id();
    //     $course = Course::find($request->course_id);
    //     $courseName = $course->name;

    //     $alreadyEnrolled = CourseEnrollment::where('user_id', $userId)
    //                         ->where('course_name', $courseName)
    //                         ->exists();

    //     if ($alreadyEnrolled) {
    //         return response()->json(['message' => 'Already enrolled']);
    //     }

    //     CourseEnrollment::create([
    //         'user_id' => $userId,
    //         'course_name' => $courseName,
    //     ]);

    //     return response()->json(['message' => 'Enrollment successful']);
    // }

    // User dashboard: show all courses + user's enrolled courses
    // public function userCourse()
    // {
    //     $user = Auth::user();
    //     $courses = Course::all();

    //     $enrolledCourses = CourseEnrollment::where('user_id', $user->id)
    //         ->with('course')
    //         ->get()
    //         ->pluck('course.name')
    //         ->toArray();

    //     return view('user.dashboard', compact('courses', 'enrolledCourses'));
    // }

    public function addVideoForm($id)
{
    $course = Course::findOrFail($id);
    return view('admin.courses.add_video', compact('course'));
}




    public function userCourse()
{
    $user = Auth::user();

    $courses = Course::paginate(3); // use pagination for better UI performance

    $enrolledCourses = CourseEnrollment::where('user_id', $user->id)
        ->pluck('course_name') // just the name as plain string
        ->toArray();

    return view('user.dashboard', compact('courses', 'enrolledCourses'));
}


    // Show public course list (e.g., homepage view)
    

    private function convertToEmbedUrl($url)
{
    if (strpos($url, 'watch?v=') !== false) {
        return str_replace('watch?v=', 'embed/', $url);
    } elseif (strpos($url, 'youtu.be/') !== false) {
        return str_replace('youtu.be/', 'youtube.com/embed/', $url);
    }
    return $url;
}

public function showCourses()
{
    $courses = Course::paginate(3); // Only 3 per page
    return view('user.courses', compact('courses'));
}

// public function enroll(Request $request)
// {
//     $request->validate([
//         'course_id' => 'required|exists:courses,id',
//     ]);

//     CourseEnrollment::firstOrCreate([
//         'user_id' => Auth::id(),
//         'course_id' => $request->course_id,
//     ]);

//     return response()->json(['success' => true]);
// }

public function enroll(Request $request)
{
    $user = auth()->user();

    $courseId = $request->course_id;
    $course = Course::with('videos')->findOrFail($courseId);

    CourseEnrollment::firstOrCreate([
        'user_id' => $user->id,
        'course_id' => $courseId
    ]);

    return response()->json([
        'message' => 'Enrolled successfully',
        'videos' => $course->videos->pluck('video_path')
    ]);
}


public function addVideos($id)
{
    $course = Course::findOrFail($id);
    return view('admin.courses.upload_videos', compact('course'));
}


// public function storeVideo(Request $request, $courseId)
// {
//     $request->validate([
//         'videos' => 'required|array',
//         'videos.*' => 'file|mimes:mp4,mov,avi,wmv,webm|max:51200', // 50MB max per video
//     ]);

//     $course = Course::findOrFail($courseId);

//     if ($request->hasFile('videos')) {
//         foreach ($request->file('videos') as $video) {
//             $path = $video->store('course_videos', 'public');

//             CourseVideo::create([
//                 'course_id' => $course->id,
//                 'video_path' => $path,
//             ]);
//         }
//     }

//     return redirect()->route('admin.courses.index')->with('success', 'Videos uploaded successfully.');
// }
public function storeVideo(Request $request, $courseId)
{
    $request->validate([
        'videos' => 'required|array',
        'videos.*' => 'file|mimes:mp4,mov,avi,wmv,webm|max:51200', // 50MB max per video
    ]);

    $course = Course::findOrFail($courseId);

    if ($request->hasFile('videos')) {
        foreach ($request->file('videos') as $video) {
            $path = $video->store('course_videos', 'public');

            CourseVideo::create([
                'course_id' => $course->id,
                'video_path' => $path,
            ]);
        }
    }

    return redirect()->route('admin.courses.index')->with('success', 'Videos uploaded successfully.');
}


public function userCourses()
{
    $courses = Course::with('videos')->paginate(3); // or ->get()
    $enrolledCourses = auth()->check()
        ? \App\Models\CourseEnrollment::where('user_id', auth()->id())->pluck('course_id')->toArray()
        : [];

    return view('user.courses', compact('courses', 'enrolledCourses'));
}

public function editVideoForm($id)
{
    $course = Course::with('videos')->findOrFail($id);
    return view('admin.courses.edit_videos', compact('course'));
}
public function updateVideos(Request $request, $id)
{
    $course = Course::findOrFail($id);

    // Delete selected videos
    if ($request->has('delete_videos')) {
        foreach ($request->delete_videos as $videoId) {
            $video = CourseVideo::find($videoId);
            if ($video && $video->course_id == $course->id) {
                Storage::disk('public')->delete($video->video_path);
                $video->delete();
            }
        }
    }

    // Upload new videos
    if ($request->hasFile('new_videos')) {
        foreach ($request->file('new_videos') as $newVideo) {
            $path = $newVideo->store('course_videos', 'public');
            CourseVideo::create([
                'course_id' => $course->id,
                'video_path' => $path
            ]);
        }
    }

    return redirect()->route('admin.courses.index')->with('success', 'Videos updated successfully.');
}


public function youtubeVideos()
{
    return $this->hasMany(CourseYoutubeVideo::class);
}


public function addYoutubeLinks($id)
{
    $course = Course::findOrFail($id);
    return view('admin.courses.add_youtube_links', compact('course'));
}

// public function storeYoutubeLinks(Request $request, $id)
// {
//     $request->validate([
//         'youtube_links.*' => 'required|url'
//     ]);

//     foreach (array_filter($request->youtube_links) as $link) {
//         CourseYoutubeVideo::create([
//             'course_id' => $id,
//             'youtube_url' => $link
//         ]);
//     }

//     return redirect()->route('admin.courses.index')->with('success', 'YouTube videos saved.');
// }

// public function addYoutubeForm($id)
// {
//     $course = Course::findOrFail($id);
//     return view('admin.courses.add_youtube', compact('course'));
// }

public function storeYoutubeLinks(Request $request, $courseId)
{
    $request->validate([
        'youtube_urls.*' => 'nullable|url',
    ]);

    $course = Course::findOrFail($courseId);

    foreach ($request->youtube_urls as $url) {
        if ($url) {
            CourseYoutubeVideo::create([
                'course_id' => $course->id,
                'youtube_url' => $url
            ]);
        }
    }

    return redirect()->route('admin.courses.index')->with('success', 'YouTube links added successfully!');
}


public function addYoutubeForm($id)
{
    $course = Course::findOrFail($id);
    return view('admin.courses.add_youtube', compact('course'));
}

// public function storeYoutubeLinks(Request $request, $id)
// {
//     $course = Course::findOrFail($id);

//     if ($request->has('youtube_urls')) {
//         foreach ($request->youtube_urls as $url) {
//             if ($url) {
//                 CourseYoutubeVideo::create([
//                     'course_id' => $id,
//                     'youtube_url' => $url
//                 ]);
//             }
//         }
//     }

//     return redirect()->route('admin.courses.index')->with('success', 'YouTube links saved!');
// }

public function editYoutubeForm($id)
{
    $course = Course::with('youtubeVideos')->findOrFail($id);
    return view('admin.courses.edit_youtube', compact('course'));
}

public function updateYoutubeLinks(Request $request, $id)
{
    $course = Course::findOrFail($id);

    // Remove old links
    $course->youtubeVideos()->delete();

    // Add new links
    if ($request->has('youtube_urls')) {
        foreach ($request->youtube_urls as $url) {
            if ($url) {
                CourseYoutubeVideo::create([
                    'course_id' => $id,
                    'youtube_url' => $url
                ]);
            }
        }
    }

    return redirect()->route('admin.courses.index')->with('success', 'YouTube links updated!');
}

}
