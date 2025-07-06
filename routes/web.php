<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlacementController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\CoController;
use App\Http\Controllers\HomeController;




// Home
// Route::get('/', [PlacementController::class, 'home'])->name('home');
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware('web')->group(function () {
    Route::get('/login', [PlacementController::class, 'showLogin'])->name('login');
    Route::post('/login', [PlacementController::class, 'loginUser']);

    Route::get('/register', [PlacementController::class, 'showRegister'])->name('register');
    Route::post('/register-user', [PlacementController::class, 'registerUser']);

    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->middleware('auth');
});



// Register & Login
Route::get('/register', [PlacementController::class, 'showRegister'])->name('register');

Route::post('/register-user', [PlacementController::class, 'registerUser']);
Route::get('/login', [PlacementController::class, 'showLogin'])->name('login');
Route::post('/login', [PlacementController::class, 'loginUser']);
Route::get('/logout', [PlacementController::class, 'logout'])->name('logout');

// Dashboards
Route::get('/admin/dashboard', [PlacementController::class, 'adminDashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');
Route::get('/courses', [CourseController::class, 'index'])->middleware('auth')->name('user.dashboard');

Route::get('/admin/dashboard', [PlacementController::class, 'adminDashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');


    // Show add video form
Route::get('/admin/courses/{id}/add-video', [CourseController::class, 'addVideoForm'])->name('admin.courses.addVideoForm');

// Store video links
Route::post('/admin/courses/{id}/add-video', [CourseController::class, 'storeVideo'])->name('admin.courses.storeVideo');


// Admin Placement List Page
Route::get('/admin/placements', [PlacementController::class, 'index'])
    ->middleware('auth')
    ->name('admin.placements.index');
// Placements
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('placements', PlacementController::class, [
        'names' => [
            'index' => 'admin.placements.index',
            'create' => 'admin.placements.create',
            'store' => 'admin.placements.store',
            'edit' => 'admin.placements.edit',
            'update' => 'admin.placements.update',
            'destroy' => 'admin.placements.destroy',
        ]
    ]);
});

Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');



Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('user.dashboard');

// Courses
Route::get('/view-course/{person}', [CourseController::class, 'show'])->name('courses.view');
Route::post('/courses/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
Route::post('/enroll', [CourseController::class, 'enroll'])->middleware('auth')->name('enroll');
// Route::post('/userenroll', [EnrollmentController::class, 'store'])->name('enroll.store');

Route::post('/enroll', [EnrollmentController::class, 'store'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/it/courses', [CourseController::class, 'showCourses'])->name('user.courses');
    Route::post('/enroll', [CourseController::class, 'enroll'])->name('enroll');
});
// Course Resource with Custom Names
// Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/user/dashboard', function () {
    //     return view('user.dashboard'); // ✅ Your user dashboard blade
    // })->name('user.dashboard');

    //  Route::get('/user/dashboard', [CoController::class, 'showCourses'])->name('user.dashboard');
    //  Route::get('/it/courses', [CourseController::class, 'showCourses'])->name('user.courses');
    // Route::post('/enroll', [CourseController::class, 'enroll'])->name('enroll');


Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [CourseController::class, 'userCourses'])->name('courses.user');
    Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/user/dashboard', [CourseController::class, 'userCourses'])->name('courses.user');
//     Route::post('/enroll', [EnrollmentController::class, 'store'])->name('enroll');
// });

Route::get('/admin/courses/{course}/videos', [CourseController::class, 'addVideos'])->name('admin.courses.videos');
Route::POST('/admin/courses/{course}/videos', [CourseController::class, 'storeVideos'])->name('admin.courses.videos.store');

Route::get('/admin/courses/{course}/videos/edit', [CourseController::class, 'editVideoForm'])->name('admin.courses.editVideoForm');
Route::post('/admin/courses/{course}/videos/update', [CourseController::class, 'updateVideos'])->name('admin.courses.updateVideos');


Route::get('/admin/courses/{course}/youtube', [CourseController::class, 'addYoutubeLinks'])->name('admin.courses.youtube');
Route::post('/admin/courses/{course}/youtube', [CourseController::class, 'storeYoutubeLinks'])->name('admin.courses.youtube.store');

Route::get('/admin/courses/{course}/youtube', [CourseController::class, 'addYoutubeForm'])->name('admin.courses.addYoutubeForm');

Route::post('/admin/courses/{course}/youtube-links', [CourseController::class, 'storeYoutubeLinks'])
     ->name('admin.courses.storeYoutubeLinks');

Route::get('/admin/courses/{course}/edit-youtube', [CourseController::class, 'editYoutubeForm'])->name('admin.courses.editYoutubeForm');

    Route::resource('/courses', CourseController::class)->names([
        'index'   => 'admin.courses.index',
        'create'  => 'admin.courses.create',
        'store'   => 'admin.courses.store',
        'edit'    => 'admin.courses.edit',
        'update'  => 'admin.courses.update',
        'destroy' => 'admin.courses.destroy',
        'show'    => 'admin.courses.show',
    ]);


    Route::get('/admin/courses/{course}/add-youtube', [CourseController::class, 'addYoutubeForm'])->name('admin.courses.addYoutubeForm');
Route::post('/admin/courses/{course}/store-youtube', [CourseController::class, 'storeYoutubeLinks'])->name('admin.courses.storeYoutubeLinks');

Route::get('/admin/courses/{course}/edit-youtube', [CourseController::class, 'editYoutubeForm'])->name('admin.courses.editYoutubeForm');
Route::post('/admin/courses/{course}/update-youtube', [CourseController::class, 'updateYoutubeLinks'])->name('admin.courses.updateYoutubeLinks');


    // Route::get('/ad/dashboard', [CourseController::class, 'index'])->name('admin.dashboard');
// Route::get('/user/dashboard', [CourseController::class, 'userCourses'])
//     ->middleware('auth')
//     ->name('user.dashboard'); 

//     Route::middleware(['auth'])->group(function () {
//     Route::get('/user/dashboard', [CourseController::class, 'userCourses'])->name('user.dashboard');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [PlacementController::class, 'user.dashboard']);
});


// Admin Views
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/enrollments', [AdminEnrollmentController::class, 'index'])->name('admin.enrollments.index');
Route::get('/admin/placements', [PlacementController::class, 'index'])->name('admin.placements.index');
Route::get('/admin/placements/{id}/edit', [PlacementController::class, 'edit'])->name('admin.placements.edit');
Route::delete('/admin/placements/{id}', [PlacementController::class, 'destroy'])->name('admin.placements.destroy');

Route::get('admin/placements/create', [PlacementController::class, 'create'])->name('admin.placements.create');
Route::post('admin/placements', [PlacementController::class, 'store'])->name('admin.placements.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/it/courses', [CourseController::class, 'showCourses'])->name('user.courses');
});

Route::get('/it/courses', [CourseController::class, 'showCourses'])->name('user.courses');

Route::get('/user/dashboard', [CourseController::class, 'showCourses'])->middleware('auth')->name('user.courses');

// Route::get('/it/courses', [Controller::class, 'showCourses'])->name('user.dashboard');

Route::get('/user/dashboard', [HomeController::class, 'showCourses'])->name('user.dashboard');
